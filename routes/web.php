<?php

use Illuminate\Support\Facades\Route;


//Routes for role Management (Super Admin)
Route::get('/', 'SuperAdminController@viewIndex');
//Routes for Role controlling
Route::get('/view-add-role-page', 'SuperAdminController@addRolePage');
Route::post('/add-role', 'SuperAdminController@CreateRole');
Route::get('/inactive-role/{id}', 'SuperAdminController@inactiveRoleInfo');
Route::get('/active-role/{id}', 'SuperAdminController@activeRoleInfo');
Route::get('/edit-role/{id}', 'SuperAdminController@editRole');
Route::post('/update-role', 'SuperAdminController@updateRoleInfo');


//routes for Employee Management (Super Admin)
Route::get('/view-hotel-staffs', 'SuperAdminController@viewTeam');
Route::get('/manager-registration-page', 'SuperAdminController@viewEmployeePage');
Route::post('/create-manager', 'SuperAdminController@newEmployee')->name('create-manager');
Route::get('/edit-manager/{id}', 'SuperAdminController@editEmployee');
Route::post('update-manager', 'SuperAdminController@UpdateEmployee')->name('update-manager');
Route::get('active-manager/{id}', 'SuperAdminController@activeEmployeeInfo')->name('active-manager');
Route::get('deActive-manager/{id}', 'SuperAdminController@inactiveEmployeeInfo')->name('Inactive-manager');
Auth::routes();

//routes for Room Management (Manager)
Route::get('/dashboard-GM', 'ManagerController@dashboard');
Route::get('/room-add-form', 'ManagerController@roomAddForm');
Route::post('/create-room', 'ManagerController@newRoom')->name('create-room');
Route::get('/add-room-type', 'ManagerController@roomTypeForm');
Route::get('/edit-room-type/{id}', 'ManagerController@editRoomTypeForm');
Route::post('/update-room-type', 'ManagerController@UpdateRoomType');
Route::post('/new-room-type', 'ManagerController@newRoomType');
Route::get('/edit-room/{id}', 'ManagerController@editRoom');
Route::post('/update-room', 'ManagerController@UpdateRoomInfo')->name('update-room');
//routes for Booking infos (Manager)
Route::get('/show-all-bookings', 'ManagerController@ShowBookings');
Route::get('/view-details-booking/{id}', 'ManagerController@viewBookingDetails');
//Route::get('show-all-active-bookings', 'ManagerController@showActiveBookings');
Route::get('show-all-edited-bookings', 'ManagerController@ShowEditedBookings');

//routes for Manage Employee Info for Manager
Route::get('/employee-registration-page', 'ManagerController@viewEmployeePage');
Route::post('/create-employee', 'ManagerController@newEmployee')->name('create-employee');
Route::get('/edit-employee/{id}', 'ManagerController@editEmployee');
Route::post('update-employee', 'ManagerController@UpdateEmployee')->name('update-employee');
Route::get('active-employee/{id}', 'ManagerController@activeEmployeeInfo')->name('active-employee');
Route::get('deActive-employee/{id}', 'ManagerController@inactiveEmployeeInfo')->name('Inactive-employee');

Route::get('/view-new-staff-adding-form/{id}', 'ManagerController@NewStaffInfoForm');
Route::post('/save-new-staff-details', 'ManagerController@storeStaffInfo');
Route::post('/update-staff-details', 'ManagerController@UpdateStaffInfo');

//routes for Manage Additional costs of Manager
Route::get('/additional-cost-form', 'ManagerController@viewAdditionalExpence');
Route::post('create-additional-cost', 'ManagerController@createAdditionalCost')->name('create-additional-cost');
Route::get('edit-additional-cost/{id}', 'ManagerController@editAdditionalCost');
Route::post('update-additional-cost', 'ManagerController@UpdateAdditioanlCost')->name('update-additional-cost');

//routes for manage Monthly salaries of Staffs for Manager
Route::get('/salary-form', 'ManagerController@salaryForm');
Route::post('create-salary-info', 'ManagerController@newSalary')->name('create-salary-info');
Route::get('/edit-salary-info/{id}', 'ManagerController@EditSalary');
Route::post('/update-salary-info', 'ManagerController@UpdateSalary')->name('update-salary-info');
Route::get('search-salaries', 'ManagerController@searchFormForSalary')->name('search-salaries');
Route::get('/check-salary', 'ManagerController@checkSalary')->name('check-salary');
Route::post('/print-salary-statement', 'ManagerController@PrintSalary');

//routes for manager Employee Leave Records routes
Route::get('/leave-records-staffs', 'ManagerController@StaffLeaveForm');
Route::post('/new-leave-records', 'ManagerController@createStaffLeave')->name('create-leave');
Route::get('/edit-leave-records', 'ManagerController@editStaffLeave');
//routes for tax issues
Route::get('/view-tax-page', 'ManagerController@addTaxPage');
Route::post('/add-tax', 'ManagerController@CreateTax');
Route::get('/edit-tax/{id}', 'ManagerController@editTax');
Route::get('/delete-tax/{id}', 'ManagerController@deleteTax');
Route::post('/update-tax', 'ManagerController@updateTax');

//routes for customer management Manager
Route::get('customer-entry-form','ManagerController@showCustomerForm');
Route::get('show-all-customers','ManagerController@allCustomers')->name('show-all-customers');
Route::post('create-customer','ManagerController@createCustomer')->name('create-customer');
Route::get('edit-customer/{id}','ManagerController@editCustomer');
Route::post('update-customer','ManagerController@updateCustomer')->name('update-customer');

//Refund Routes start from here
Route::get('/cancel-advance-booking/{id}/{room}','ManagerController@cancelForm');
Route::post('/cancel-booking-with-refund','ManagerController@cancelBooking')->name('cancel-booking-with-refund');
Route::get('/all-cancel-bookings','ManagerController@allCancelBookings');

//routes for manager All reports
Route::get('overall-report', 'ReportController@OverallReports');
Route::post('overall-report-pdf', 'ReportController@PdfOfOverallReports');
Route::get('booking-reports', 'ReportController@BookingReports');
Route::post('generate-pdf-for-booking-report', 'ReportController@PfdOfBookingReports');
Route::get('staff-leave-reports', 'ReportController@StaffLeaveReports');
Route::post('generate-pdf-for-Staff-leave', 'ReportController@PfdOfStaffLeaveReports');
Route::get('Expense-reports', 'ReportController@ExpenseReports');
Route::get('generate-pdf-for-Expense-reports', 'ReportController@PfdOfExpenseReports');
Route::get('house-keeping-reports', 'ReportController@HouseKeepingReports');
Route::post('generate-pdf-for-housekeeping-reports-after-booking', 'ReportController@PfdOfAfterBookingServiceReports');

Route::get('regular-house-keeping-reports', 'ReportController@RegularHouseKeepingReports');
Route::post('generate-pdf-for-regular-housekeeping-reports', 'ReportController@PfdOfRegularHouseKeepingReports');

//Receptionist Daily Transaction
Route::get('daily-transaction', 'ReceptionistController@dailyTransaction');



//routes for Hotel Receptionist
Route::get('/front-desk', 'ReceptionistController@viewHome');
Route::get('/book-room', 'ReceptionistController@checkBookingPage');
Route::get('/check-bookings', 'ReceptionistController@QueryBooking');
Route::get('attempt-bookings', 'ReceptionistController@attemptbooking');
Route::get('/confirm-room/{id}', 'ReceptionistController@ConfirmBookingPage');
Route::post('/create-booking', 'ReceptionistController@createBooking')->name('create-booking');
Route::post('/update-booking', 'ReceptionistController@UpdateBookings')->name('update-booking');
Route::get('/edit-bookings/{id}', 'ReceptionistController@EditBookingsForm');
Route::post('/edit-date-calculation', 'ReceptionistController@dateCalculation');
Route::post('/view-cusotmer-info', 'ReceptionistController@fetchCustomerData');
Route::get('/all-current-bookings','ReceptionistController@CurrentBookings')->name('current-bookings');
Route::get('/advance-bookings','ReceptionistController@AdvanceBookings')->name('advance-bookings');
Route::get('/confirm-advance-bookings/{id}','ReceptionistController@ConfirmAvdanceBookingToRegular')->name('advance-bookings');
Route::get('/cancel-advance-bookings/{id}','ReceptionistController@CancelAdvanceBooking')->name('cancel-advance-bookings');
Route::get('/bookings-history','ReceptionistController@BookingsHistory');
Route::get('/view-bookings-by-id/{id}','ReceptionistController@viewBookingDetails');


//routes for Hotel House keeping Department
Route::get('house-keeping','HouseKeepingController@viewHouseKeepingDashboard');
Route::get('Room-Status','HouseKeepingController@roomstatusPreview');
Route::get('assign-staffs/{id}','HouseKeepingController@staffAssigning');
Route::get('complete-tasks/{id}','HouseKeepingController@CompleteAssigningTaskForm');
Route::get('complete-regular-tasks/{id}','HouseKeepingController@CompleteRegularAssigningTaskForm');
Route::post('complete-afterBooking-service','HouseKeepingController@CompleteAssignedTask')->name('complete-afterBooking-service');
Route::post('complete-regular-service','HouseKeepingController@RegularTaskCompletion')->name('complete-regular-service');
Route::get('active-Services','HouseKeepingController@ActiveServices');
Route::post('room-service','HouseKeepingController@NewRoomService')->name('Post-booking-service');
Route::post('regular-hotel-services','HouseKeepingController@RegularHotelServices')->name('regular-hotel-services');
Route::get('Regular-room-service','HouseKeepingController@RegularRoomServices');


Route::get('daily-history','HouseKeepingController@dailyServiceHistory');


Route::get('/partial-payment-form/{id}','PaymentController@viewPaymentForm');
Route::post('/partial-payment-agianst-booking','PaymentController@storePayment')->name('partialPayment');
Route::get('/additional-service-costs/{id}','PaymentController@ServiceCostForm');
Route::post('/store-service-costs','PaymentController@storeServiceInfo')->name('StoreBookingAdditional');
Route::get('/view-checkout-form/{id}','PaymentController@checkOutForm');
Route::post('/store-checkout','PaymentController@storeCheckoutInfo')->name('saveCheckout');
Route::get('/bill-generate/{id}','ReportController@generateBill');
Route::get('/invoice-generate/{id}','ReportController@GenerateInvoice');

//Routes for Deputy Manager
Route::get('/dm-panel','DeputyManagerController@IndexPageDm');
