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

Route::get('/', 'myController@returnHome');

/* QUAN LY DIEM VA CAP BANG */

/* Cac thao tac voi danh sach sinh vien */
//Them sinh vien moi
Route::post('studentData', ['as' => 'addStudentList', 'uses' => 'studentController@addStudentList']);
//Tim thong tin tat ca sinh vien
Route::get('editStudentList', 'studentController@editStudentList');
//Cap nhat thong tin sinh vien
Route::post('updateStudentInfo', ['as' => 'updateStudentInfo', 'uses' => 'studentController@updateStudentInfo']);
//Xoa sinh vien khoi danh sach
Route::post('deleteStudentList', ['as' => 'deleteStudentList', 'uses' => 'studentController@deleteStudentList']);
//-------------------------------------------------------------------------------------------------------------------------
/* Cac thao tac voi danh sach giang vien */
//Tim thong tin tat ca giang vien
Route::get('listTeacher', 'teacherController@getListTeacher')->name('listTeacher');
//Xoa giang vien khoi danh sach
Route::post('deleteTeacher', ['as' => 'deleteTeacher', 'uses' => 'teacherController@deleteTeacher']);
//Them giang vien moi
Route::post('teacherData', ['as' => 'addTeacher', 'uses' => 'teacherController@addTeacherList']);
//Cap nhat thong tin giang vien
Route::post('updateTeacherInfo', ['as' => 'updateTeacherInfo', 'uses' => 'teacherController@updateTeacherInfo']);
//-------------------------------------------------------------------------------------------------------------------------
/* Cac thao tac voi danh sach admin */
//Them admin moi
Route::post('adminData', ['as' => 'addAdminList', 'uses' => 'adminController@addAdminList']);
//Tim thong tin tat ca admin
Route::get('editAdminList', 'adminController@editAdminList');
//Cap nhat thong tin quan tri vien
Route::post('updateAdminInfo', ['as' => 'updateAdminInfo', 'uses' => 'adminController@updateAdminInfo']);
//Xoa quan trij vien khoi danh sach
Route::post('deleteAdminList', ['as' => 'deleteAdminList', 'uses' => 'adminController@deleteAdminList']);
//-------------------------------------------------------------------------------------------------------------------------
/* Cac thao tac voi danh sach hoc phan */
//Them hoc phan moi
Route::post('courseData', ['as' => 'addCourseList', 'uses' => 'courseController@addCourseList']);
//Tim thong tin tat ca hoc phan
Route::get('editCourseList', 'courseController@editCourseList');     //Doi voi admin
Route::get('findAllCourse', 'courseController@findAllCourse');      //Doi voi nguoi binh thuong
//Xoa hoc phan khoi danh sach
Route::post('deleteCourseList', ['as' => 'deleteCourseList', 'uses' => 'courseController@deleteCourseList']);
//Sua thong tin hoc phan
Route::post('updateCourseInfo', ['as' => 'updateCourseInfo', 'uses' => 'courseController@updateCourseInfo']);
//-------------------------------------------------------------------------------------------------------------------------
/* Cac thao tac voi danh sach lop */
//Them lop moi
Route::post('classData', ['as' => 'addClassList', 'uses' => 'classController@addClassList']);
//Tim thong tin tat ca cac lop
Route::get('editClassList', 'classController@editClassList');
//Xoa lop khoi danh sach
Route::post('deleteClassList', ['as' => 'deleteClassList', 'uses' => 'classController@deleteClassList']);
//Sua thong tin lop
Route::post('updateClassInfo', ['as' => 'updateClassInfo', 'uses' => 'classController@updateClassInfo']);
//Tim thong tin cac sinh vien trong mot lop
Route::get('classList', 'classController@classList');
Route::post('findClassList', ['as' => 'classList', 'uses' => 'classController@classList']);
//-------------------------------------------------------------------------------------------------------------------------
//Login and Logout
Route::post('account/loginResult', ['as' => 'loginDemo', 'uses' => 'Auth\LoginController@postLogin']);
Route::post('accoute/logoutResult', ['as' => 'logoutDemo', 'uses' => 'myController@postLogout']);
//-------------------------------------------------------------------------------------------------------------------------
//Dang ky hoc
Route::get('enrol', 'enrolController@addEnrolList');
Route::post('enrolResult', ['as' => 'enrolResult', 'uses' => 'enrolController@addEnrolList']);
Route::post('deleteEnrolList', ['as' => 'deleteEnrolList', 'uses' => 'enrolController@deleteEnrolList']);

//Home Page
Route::get('home', 'myController@returnHome');

//Doi mat khau
Route::post('changePasswordResult', ['as' => 'changePassword', 'uses' => 'personalInfoController@changePassword']);

//Thong tin ca nhan
Route::get('viewPersonalInfo', 'personalInfoController@viewPersonalInfo');
Route::post('updatePersonalInfoResult', ['as' => 'updatePersonalInfo', 'uses' => 'personalInfoController@updatePersonalInfo']);

//Tim thong tin dang ky lop
Route::get('findRegister', 'searchController@studentRegister');
Route::post('studentRegister', ['as' => 'studentRegister', 'uses' => 'searchController@studentRegister']);

//Tim thong tin hoc phi
Route::get('findStudentFee', 'searchController@studentFee');
Route::post('adminFindStudentFee', ['as' => 'findStudentFee', 'uses' => 'searchController@studentFee']);

//Tim thong tin lo trinh hoc
Route::get('studyPath', 'searchController@studyPath');
Route::post('adminFindStudyPath', ['as' => 'studyPath', 'uses' => 'searchController@studyPath']);

//Cap bang
Route::get('certificate', 'myController@certificate');
//-------------------------------------------------------------------------------------------------------------------------
/* Cac thao tac voi diem so sinh vien */
//Giang vien cho diem
Route::get('findTeachingClass', 'pointController@findTeachingClass');
Route::get('givePoint/{classId}', 'pointController@givePoint');
Route::post('calculatePoint', ['as' => 'calculatePoint', 'uses' => 'pointController@calculatePoint']);

//Admin sua diem
Route::post('editStudentPoint', ['as' => 'editStudentPoint', 'uses' => 'pointController@findTeachingClass']);

//Sinh vien tra cuu diem
Route::get('studentPoint', 'pointController@studentPoint');

//Admin xu ly diem
Route::get('pointProcess', 'pointController@pointProcess');
//-------------------------------------------------------------------------------------------------------------------------