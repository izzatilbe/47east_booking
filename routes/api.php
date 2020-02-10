<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Venues
    Route::post('venues/media', 'VenueApiController@storeMedia')->name('venues.storeMedia');
    Route::apiResource('venues', 'VenueApiController');

    // Accommodations
    Route::post('accommodations/media', 'AccommodationApiController@storeMedia')->name('accommodations.storeMedia');
    Route::apiResource('accommodations', 'AccommodationApiController');

    // Accom Categories
    Route::post('accom-categories/media', 'AccomCategoryApiController@storeMedia')->name('accom-categories.storeMedia');
    Route::apiResource('accom-categories', 'AccomCategoryApiController');

    // Venue Categories
    Route::post('venue-categories/media', 'VenueCategoryApiController@storeMedia')->name('venue-categories.storeMedia');
    Route::apiResource('venue-categories', 'VenueCategoryApiController');

    // Venue Tags
    Route::apiResource('venue-tags', 'VenueTagApiController');

    // Accom Tags
    Route::apiResource('accom-tags', 'AccomTagApiController');

    // Accom Amenities
    Route::post('accom-amenities/media', 'AccomAmenityApiController@storeMedia')->name('accom-amenities.storeMedia');
    Route::apiResource('accom-amenities', 'AccomAmenityApiController');

    // Venue Amenities
    Route::post('venue-amenities/media', 'VenueAmenityApiController@storeMedia')->name('venue-amenities.storeMedia');
    Route::apiResource('venue-amenities', 'VenueAmenityApiController');

    // Customers
    Route::apiResource('customers', 'CustomerApiController');

    // Expense Categories
    Route::apiResource('expense-categories', 'ExpenseCategoryApiController');

    // Income Categories
    Route::apiResource('income-categories', 'IncomeCategoryApiController');

    // Expenses
    Route::apiResource('expenses', 'ExpenseApiController');

    // Incomes
    Route::apiResource('incomes', 'IncomeApiController');

    // Employees
    Route::apiResource('employees', 'EmployeeApiController');

    // Business Units
    Route::apiResource('business-units', 'BusinessUnitApiController');

    // Dormitory Bookings
    Route::apiResource('dormitory-bookings', 'DormitoryBookingApiController');

    // Venue Bookings
    Route::apiResource('venue-bookings', 'VenueBookingApiController');

    // Venue Packages
    Route::apiResource('venue-packages', 'VenuePackageApiController');

    // Staycation Bookings
    Route::apiResource('staycation-bookings', 'StaycationBookingApiController');

    // Coworkings
    Route::apiResource('coworkings', 'CoworkingApiController');
});