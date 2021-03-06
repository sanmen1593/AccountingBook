<?php

namespace App\Models\ExpensesCategories;

use Auth;
use App\Models\ExpensesCategories\ExpensesCategories;
use App\Models\Expenses\ExpensesFunctions;
use App\Models\DateFunctions;
use App\Models\Expenses\Expenses;
use App\Models\Savings\Savings;
use DB;

class ExpensesCategoriesFunctions {

    public static function calculateExpensesCategoryValue($category) {
        $dates = DateFunctions::firstAndLastDayOfActualMonth();
        $monthstartdaystring = DateFunctions::dateToString($dates[0]);
        $subcategories = ExpensesCategories::where('superior_cat', '=', $category->id)->get();
        $expenses = Expenses::where('date', '>=', $monthstartdaystring)
                ->where(function($query) use ($subcategories, $category) {
            $query->orWhere('expensesCategory_id', '=', $category->id);
            foreach ($subcategories as $subcategory) {
                $query->orWhere('expensesCategory_id', '=', $subcategory->id);
            }
        });
        return ExpensesFunctions::calculateTotalExpenses($expenses->orderBy('date')->get());
    }

    public static function getExpensesCategories($category) {
        $dates = DateFunctions::firstAndLastDayOfActualMonth();
        $monthstartdaystring = DateFunctions::dateToString($dates[0]);
        $subcategories = ExpensesCategories::where('superior_cat', '=', $category->id)->get();
        $expenses = Expenses::where('date', '>=', $monthstartdaystring)
                ->where(function($query) use ($subcategories, $category) {
            $query->orWhere('expensesCategory_id', '=', $category->id);
            foreach ($subcategories as $subcategory) {
                $query->orWhere('expensesCategory_id', '=', $subcategory->id);
            }
        });
        return $expenses->orderBy('date')->get();
    }

    public static function getExpensesCategoriesFromDates($category, $date1, $date2) {
        $subcategories = ExpensesCategories::where('superior_cat', '=', $category->id)->get();
        $expenses = Expenses::where('date', '>=', $date1)
                ->where('date', '<=', $date2)
                ->where(function($query) use ($subcategories, $category) {
            $query->orWhere('expensesCategory_id', '=', $category->id);
            foreach ($subcategories as $subcategory) {
                $query->orWhere('expensesCategory_id', '=', $subcategory->id);
            }
        });
        return $expenses->orderBy('date')->get();
    }

    public static function getCategoriesAndSubcategories() {
        $categories = ExpensesCategories::where('user_id', '=', Auth::user()->id)->get();
        if (count($categories) < 1) {
            return [];
        }
        $superiorcategories = [];
        $categoriessuperior = [];
        $totalcategories = 0;
        foreach ($categories as $category) {
            if ($category->superior_cat == null) {
                $superiorcategories[$category->id] = [];
                $category->amount = ExpensesCategoriesFunctions::calculateExpensesCategoryValue($category);
                array_push($categoriessuperior, $category);
                $totalcategories +=1;
            }
        }
        foreach ($categories as $category) {
            if ($category->superior_cat != null) {
                $category->amount = ExpensesCategoriesFunctions::calculateExpensesCategoryValue($category);
                array_push($superiorcategories[$category->superior_cat], $category);
            }
        }
        $categoriesarray = [$categoriessuperior, $superiorcategories];
        return $categoriesarray;
    }

    public static function getTotalBudget() {
        $categories = ExpensesCategories::where('user_id', '=', Auth::user()->id)
                ->whereNull('superior_cat')
                ->get();
        $savings = Savings::where('user_id', '=', Auth::user()->id)->get();
        $totalBudget = 0;
        if (count($categories) > 1) {
            foreach ($categories as $category) {
                $totalBudget += $category->budget;
            }
        }
        if (count($savings) >= 1) {
            foreach ($savings as $saving) {
                $totalBudget += $saving->budget;
            }
        }
        return $totalBudget;
    }

}
