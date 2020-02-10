<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);
// Admin

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Venues
    Route::delete('venues/destroy', 'VenueController@massDestroy')->name('venues.massDestroy');
    Route::post('venues/media', 'VenueController@storeMedia')->name('venues.storeMedia');
    Route::post('venues/ckmedia', 'VenueController@storeCKEditorImages')->name('venues.storeCKEditorImages');
    Route::resource('venues', 'VenueController');

    // Accommodations
    Route::delete('accommodations/destroy', 'AccommodationController@massDestroy')->name('accommodations.massDestroy');
    Route::post('accommodations/media', 'AccommodationController@storeMedia')->name('accommodations.storeMedia');
    Route::post('accommodations/ckmedia', 'AccommodationController@storeCKEditorImages')->name('accommodations.storeCKEditorImages');
    Route::resource('accommodations', 'AccommodationController');

    // Accom Categories
    Route::delete('accom-categories/destroy', 'AccomCategoryController@massDestroy')->name('accom-categories.massDestroy');
    Route::post('accom-categories/media', 'AccomCategoryController@storeMedia')->name('accom-categories.storeMedia');
    Route::post('accom-categories/ckmedia', 'AccomCategoryController@storeCKEditorImages')->name('accom-categories.storeCKEditorImages');
    Route::resource('accom-categories', 'AccomCategoryController');

    // Venue Categories
    Route::delete('venue-categories/destroy', 'VenueCategoryController@massDestroy')->name('venue-categories.massDestroy');
    Route::post('venue-categories/media', 'VenueCategoryController@storeMedia')->name('venue-categories.storeMedia');
    Route::post('venue-categories/ckmedia', 'VenueCategoryController@storeCKEditorImages')->name('venue-categories.storeCKEditorImages');
    Route::resource('venue-categories', 'VenueCategoryController');

    // Venue Tags
    Route::delete('venue-tags/destroy', 'VenueTagController@massDestroy')->name('venue-tags.massDestroy');
    Route::resource('venue-tags', 'VenueTagController');

    // Accom Tags
    Route::delete('accom-tags/destroy', 'AccomTagController@massDestroy')->name('accom-tags.massDestroy');
    Route::resource('accom-tags', 'AccomTagController');

    // Accom Amenities
    Route::delete('accom-amenities/destroy', 'AccomAmenityController@massDestroy')->name('accom-amenities.massDestroy');
    Route::post('accom-amenities/media', 'AccomAmenityController@storeMedia')->name('accom-amenities.storeMedia');
    Route::post('accom-amenities/ckmedia', 'AccomAmenityController@storeCKEditorImages')->name('accom-amenities.storeCKEditorImages');
    Route::resource('accom-amenities', 'AccomAmenityController');

    // Venue Amenities
    Route::delete('venue-amenities/destroy', 'VenueAmenityController@massDestroy')->name('venue-amenities.massDestroy');
    Route::post('venue-amenities/media', 'VenueAmenityController@storeMedia')->name('venue-amenities.storeMedia');
    Route::post('venue-amenities/ckmedia', 'VenueAmenityController@storeCKEditorImages')->name('venue-amenities.storeCKEditorImages');
    Route::resource('venue-amenities', 'VenueAmenityController');

    // Customers
    Route::delete('customers/destroy', 'CustomerController@massDestroy')->name('customers.massDestroy');
    Route::resource('customers', 'CustomerController');

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Expense Categories
    Route::delete('expense-categories/destroy', 'ExpenseCategoryController@massDestroy')->name('expense-categories.massDestroy');
    Route::resource('expense-categories', 'ExpenseCategoryController');

    // Income Categories
    Route::delete('income-categories/destroy', 'IncomeCategoryController@massDestroy')->name('income-categories.massDestroy');
    Route::resource('income-categories', 'IncomeCategoryController');

    // Expenses
    Route::delete('expenses/destroy', 'ExpenseController@massDestroy')->name('expenses.massDestroy');
    Route::resource('expenses', 'ExpenseController');

    // Incomes
    Route::delete('incomes/destroy', 'IncomeController@massDestroy')->name('incomes.massDestroy');
    Route::resource('incomes', 'IncomeController');

    // Expense Reports
    Route::delete('expense-reports/destroy', 'ExpenseReportController@massDestroy')->name('expense-reports.massDestroy');
    Route::resource('expense-reports', 'ExpenseReportController');

    // Employees
    Route::delete('employees/destroy', 'EmployeeController@massDestroy')->name('employees.massDestroy');
    Route::resource('employees', 'EmployeeController');

    // Business Units
    Route::delete('business-units/destroy', 'BusinessUnitController@massDestroy')->name('business-units.massDestroy');
    Route::resource('business-units', 'BusinessUnitController');

    // Dormitory Bookings
    Route::delete('dormitory-bookings/destroy', 'DormitoryBookingController@massDestroy')->name('dormitory-bookings.massDestroy');
    Route::resource('dormitory-bookings', 'DormitoryBookingController');

    // Venue Bookings
    Route::delete('venue-bookings/destroy', 'VenueBookingController@massDestroy')->name('venue-bookings.massDestroy');
    Route::resource('venue-bookings', 'VenueBookingController');

    // Venue Packages
    Route::delete('venue-packages/destroy', 'VenuePackageController@massDestroy')->name('venue-packages.massDestroy');
    Route::resource('venue-packages', 'VenuePackageController');

    // Staycation Bookings
    Route::delete('staycation-bookings/destroy', 'StaycationBookingController@massDestroy')->name('staycation-bookings.massDestroy');
    Route::resource('staycation-bookings', 'StaycationBookingController');

    // Coworkings
    Route::delete('coworkings/destroy', 'CoworkingController@massDestroy')->name('coworkings.massDestroy');
    Route::resource('coworkings', 'CoworkingController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
});