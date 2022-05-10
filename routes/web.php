<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
 //return view('welcome');
  // Artisan::call('config:cache');
    return redirect('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/allCounts', 'HomeController@allCounts')->name('allCounts');

Route::get('/employeesPerformance', 'HomeController@employeesPerformance')->name('employeesPerformance');
Route::post('/getEmployeesPerformance',  'HomeController@getEmployeesPerformance')->name('getEmployeesPerformance');

Route::get('/news/{id}', 'HomeController@news')->name('news');

Route::get('/new', 'HomeController@new')->name('new');


Route::get('/performanceMonthly', 'HomeController@performanceMonthly')->name('performanceMonthly');
Route::get('/performanceYearly', 'HomeController@performanceYearly')->name('performanceYearly');

Route::get('analysis', 'HomeController@analysis');
Route::get('employees_performance', 'HomeController@employees_performance')->name('employees_performance');

Route::get('performance', 'HomeController@performance');



Route::post('/searchLead', 'LeadsController@searchLead')->name('searchLead');

Route::get('/leads/view',  'LeadsController@views')->name('getViewLeads');
Route::get('/emp/leads/view',  'EmployeesController@single_emp_views')->name('getSingleViewLeads');
Route::get('/new_emp_per', 'EmployeesController@new_emp_per')->name('new_emp_per');

Route::get('leads/assign', 'LeadsController@assign');
Route::post('/leads/assign',  'LeadsController@assigns')->name('assignLead');

Route::post('/leads/getLeads',  'LeadsController@getLeads')->name('getLeads');
Route::post('/feedbacks/getFeedbacks',  'FeedbacksController@getFeedbacks')->name('getFeedbacks');


Route::get('leads/closed', 'LeadsController@closed');
Route::get('leads/failed', 'LeadsController@failed');

Route::get('profile',  'ProfileController@profile')->name('profile');
Route::post('profileUpdate',  'ProfileController@profileUpdate')->name('profileUpdate');

Route::get('/installment',  'InstallmentsController@installment');
Route::post('/searchInstallment',  'InstallmentsController@searchInstallment')->name('searchInstallment');;

Route::get('/installments/view/{id}',  'InstallmentsController@view');

Route::get('/feedbacks/add/{id}',  'FeedbacksController@add');

Route::get('/notes/add/{id}',  'NotesController@add');
Route::get('/notes/in_progress',  'NotesController@in_progress')->name('in_progress');
Route::get('/get_notifications',  'HomeController@get_notifications')->name('get_notifications');



Route::get('/notes/view/{id}',  'NotesController@view');

Route::get('/reminder/view',  'ReminderController@view');


Route::post('changeStatus', 'LeadsController@changeStatus')->name('changeStatus');
Route::post('updateAmount', 'SourcesController@updateAmount')->name('updateAmount');
Route::post('assignLeadsEmployee', 'LeadsController@assignLeadsEmployee')->name('assignLeadsEmployee');
Route::post('assignLeadsManager', 'LeadsController@assignLeadsManager')->name('assignLeadsManager');
Route::post('assignHalfLeadsEmployee', 'LeadsController@assignHalfLeadsEmployee')->name('assignHalfLeadsEmployee');
Route::get('/employees/addManagerEmployee',  'EmployeesController@addManagerEmployee')->name('employees.addManagerEmployee');
Route::get('/leads/assign_lead_emp', 'LeadsController@assign_lead_emp')->name('employees.assign_lead_emp');
Route::get('/leads/campname',  'LeadsController@campname')->name('leads.campname');
Route::get('/leads/test_fn',  'LeadsController@test_fn')->name('leads.test_fn');
Route::get('/leads/assigned_leads',  'LeadsController@assigned_leads')->name('leads.assigned_leads');


Route::post('/leads/assingParticalurleads',  'LeadsController@assingParticalurleads')->name('leads.assingParticalurleads');

Route::get('/employees/editManagerEmployee/{id}/edit',  'EmployeesController@editManagerEmployee')->name('employees.editManagerEmployee');
Route::patch('employees/updateManagerEmployee/{id}', 'EmployeesController@updateManagerEmployee')->name('employees.updateManagerEmployee');

Route::resources([
	'managers' => 'ManagersController',
    'employees' => 'EmployeesController',
    'sources' => 'SourcesController',
    'leads' => 'LeadsController',
    'installments' => 'InstallmentsController',
    'feedbacks' => 'FeedbacksController',
    'notes' => 'NotesController'
]);

Route::get('/sources/{id}/camp_assign',  'SourcesController@camp_assign')->name('camp_assign');
Route::get('/campaign/camp_assign_emp',  'NotesController@camp_assign_emp')->name('camp_assign_emp');
Route::get('/campaign/camp_assign_emp/{id}',  'NotesController@view_camp')->name('employe.view_camp');
Route::get('/sources/{id}/leadview',  'LeadsController@leadview')->name('leadview');
Route::get('/sources/delete/{id}',  'SourcesController@delete');


Route::get('/leads/delete/{id}',  'LeadsController@delete');

Route::get('/employees/delete/{id}',  'EmployeesController@delete');
Route::get('/employees/{id}/performace',  'EmployeesController@performace');


Route::get('/employees/statusUpdate/{id}',  'EmployeesController@statusUpdate');

Route::get('/managers/delete/{id}',  'ManagersController@delete');

Route::get('/managers/statusUpdate/{id}',  'ManagersController@statusUpdate');

Route::get('/deleteManagerEmployee/delete/{id}',  'EmployeesController@deleteManagerEmployee');

Route::get('employee/lhs_report/{id}',  'EmployeesController@lhs_report')->name('employee.lhs_report');
Route::post('employee/lhs_report_save',  'EmployeesController@lhs_report_save')->name('employee.lhs_report_save');
Route::get('employee/lhs_report/edit/{id}',  'EmployeesController@edit_lhs_report')->name('employee.edit_lhs_report');
Route::post('employee/lhs_report/update',  'EmployeesController@update_lhs_report')->name('employee.update_lhs_report');
Route::get('employee/lhs_report/view_lhs/{id}',  'EmployeesController@view_lhs')->name('employee.view_lhs');
/* Daily Report */

Route::get('/emp_daily_report',  'EmployeesController@emp_daily_report')->name('employee.emp_daily_report');
Route::get('employee/{id}/emp_daily_report', 'DailyReportController@daily_report')->name('daily_report');



Route::get('/man_daily_report',  'EmployeesController@man_daily_report')->name('employee.man_daily_report');
Route::get('employee/man_daily_report',  'DailyReportController@man_daily_report')->name('employee.man_daily_report');


/* FIXING STATUS OF ALL LEADS IN Notes Table */


Route::get('/notes_new',  'EmployeesController@notes_new')->name('employee.notes_new');


/* ****************** */ 


Route::get('ajax-request', 'AjaxController@create');
Route::post('ajax-request', 'AjaxController@store');

Route::post('read_notification',  'HomeController@read_notification')->name('read_notification');
Route::post('clear/notification',  'HomeController@clear_notification')->name('clear_notification');


/*Excel import export*/
Route::get('export', 'ImportExportController@export')->name('export');
Route::get('import', 'ImportExportController@importLeads');
Route::post('import', 'ImportExportController@import')->name('import');
/*  Import Specific Campaign  */
Route::get('/add_leads/{id}', 'SourcesController@create_campaign')->name('create_campaign');
Route::post('import_leads', 'ImportExportController@import_leads')->name('import_leads');




/*  *****************************  */ 



Route::get('lead/generateDocx', 'LeadClosedController@generateDocx')->name('generateDocx');

/* ANMOL   */

Route::match(['get', 'post'], 'lead/exportCsv', [
    'uses' => 'LeadClosedCsv@export',
    'as'   => 'LeadClosedCsv@storeExcel',
]);
Route::get('lead/export_excel_pdf', 'LeadClosedController@export_excel_pdf')->name('export_excel_pdf');
Route::get('lead/view_pdf', 'LeadClosedController@viewpdf')->name('view_pdf');
Route::get('lead/export', 'LeadClosedController@generatePDF')->name('generatePDF');
Route::get('lead/export/{id}/pdf_down', 'LeadClosedController@generateSinglePDF')->name('generateSinglePDF');
Route::get('lead/exportCsv/{id}/report_down', 'LeadClosedCsv@reportDown')->name('reportDown');
Route::get('/employee/export', 'LeadClosedCsv@reportSingleEmployee')->name('reportSingleEmployee');
Route::get('employee/export/{id}/pdf_single_down', 'LeadClosedController@singlepdfdown')->name('singlepdfdown');

Route::get('employee/export/{id}/word_single_down', 'LeadClosedController@wordEmployeeDown')->name('wordEmployeeDown');

Route::get('/employees_performance/exportExcel', 'LeadClosedCsv@reportEmployeePerformance')->name('reportEmployeePerformance');

Route::get('lead/generateDocx', 'LeadClosedController@generateDocx')->name('generateDocx');
Route::get('lead/newDocx', 'LeadClosedController@newDocx')->name('newDocx');

Route::post('add_note', 'LeadsController@add_note')->name('add_note');
