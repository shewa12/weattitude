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

Route::get('/', "VisitorsCtrl@index")->name('public');
Route::get('/about-us', "VisitorsCtrl@aboutUs")->name('aboutUs');
Route::post('/interest-view', "VisitorsCtrl@dataByInterest")->name('dataByInterest');
Route::get('/uplifting-writing-videos', "VisitorsCtrl@writingVideos")->name('writingVideos');
Route::get('uplifting-writing-videos/tag/{tag}', "VisitorsCtrl@writingVideosTag")->name('writingVideosTag');

Route::get('/uplifting-writing-videos-detail/{id}', "VisitorsCtrl@writingVideosDetail")->name('writingVideosDetail')->where('id','[0-9]+');
Route::get('/handout-sheet', "VisitorsCtrl@hangoutSheet")->name('hangoutSheet');
Route::get('/what-participant-get', "VisitorsCtrl@doParticipants")->name('doParticipants');
Route::get('/issue-suggested-solution', "VisitorsCtrl@issueSuggestedSolution")->name('issueSuggestedSolution');

Route::get('/visitor-search-region/{location}/{hangout?}', "VisitorsCtrl@searchRegion")->name('searchRegionVisitor');
Route::get('/visitor-search-solution/{solution}', "VisitorsCtrl@searchSolution")->name('searchSolutionVisitor');
Route::get('/visitor-search-issue/{issue}', "VisitorsCtrl@searchIssue")->name('searchIssueVisitor');

Route::get('/issue-by-region/{id}', "VisitorsCtrl@searchIssubyRegion")->name('searchIssubyRegion');
Route::post('/visitor-advance-search', "VisitorsCtrl@advanceSearch")->name('advanceSearch');
Route::get('/case-study', "VisitorsCtrl@caseStudy")->name('caseStudy');
Route::get('/post-hangout/{region}', "VisitorsCtrl@postHangout")->name('postHangout');
Route::post('/download-handout/', "VisitorsCtrl@downloadHandout")->name('downloadHandout');
Route::get('/funds-inflow-outflow/', "VisitorsCtrl@funds")->name('funds');
Route::get('/why-participate/', "VisitorsCtrl@whyParticipate")->name('whyParticipate');
Route::get('/issue-detail/{id}',"VisitorsCtrl@issue_detail")->name('issueDetail');
Auth::routes();


Route::get('/login', function(){
	return view ('auth.login');
});
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/my-profile', 'HomeController@myProfile')->name('myProfile');
Route::get('/api-data', 'HomeController@apiData')->name('apiData');

Route::get('/gmap',function(){
	return view("test");
})->name('gmap');
Route::get('/markers',"HomeController@markers");
Route::get('/interest-markers',"VisitorsCtrl@interestMarker");

//Technician management start
Route::group([],function(){
	Route::get('/users',"Users@getUsers")->name('users');
	Route::post('/save-user', "Users@saveUser")->name('saveUser');
	Route::post('/update-user', "Users@updateUser")->name('updateUser');
	Route::get('/delete-user/{id}', "Users@deleteUser")->name('deleteUser')->where('id','[0-9]+');
	
	Route::get('/calendar', "Users@calendar")->name('calendar');
	Route::post('/booking-filter/', "Users@filter")->name('filter');
	Route::post('/send-booking/', "Users@sendBooking")->name('sendBooking');
});
//Technicain management end

//App user management start
Route::group([],function(){
	Route::get('/app-users',"AppUsersCtrl@getUsers")->name('appUsers');
	Route::post('/save-app-user', "AppUsersCtrl@saveUser")->name('saveAppUser');
	Route::post('/update-app-user', "AppUsersCtrl@updateUser")->name('updateAppUser');
	Route::get('/delete-app-user/{id}', "AppUsersCtrl@deleteUser")->name('deleteAppUser')->where('id','[0-9]+');
});
//App user management end

//Issue management start
Route::group([],function(){
	Route::post('/your-region',"IssueCtrl@yourRegion")->name('yourRegion');
	Route::post('/specific-region',"IssueCtrl@specificRegion")->name('specificRegion');
	Route::post('/check-duplicate-issue/{content}',"IssueCtrl@checkDuplicateIssue")->name('checkDuplicateIssue');
	Route::post('/getissue-for-region',"IssueCtrl@getIssueForRegion")->name("getIssueForRegion");
	Route::post('/save-issue', "IssueCtrl@saveIssue")->name('saveIssue');
	Route::post('/update-issue', "IssueCtrl@updateIssue")->name('updateIssue');
	Route::get('/delete-issue/{id}', "IssueCtrl@deleteIssue")->name('deleteIssue')->where('id','[0-9]+');

	Route::get('/issue-mark-delete/{type_id}/{name}', "IssueCtrl@markDelete")->name('markDelete')->where('id','[0-9]+');

});
//Service management ende

//recommendation management start
Route::group([],function(){
	Route::post('/recommendation',"RecommCtrl@getRecomm")->name('getRecomm');
	Route::post('/check-duplicate-recomm',"RecommCtrl@checkDuplicateRecomm")->name('checkDuplicateRecomm');

	Route::post('/specific-recommendation',"RecommCtrl@specRecomm")->name('specRecomm');
	
	Route::post('/save-recommendation', "RecommCtrl@saveRecomm")->name('saveRecomm');
	Route::post('/save-recommendation-for-specific-issue', "RecommCtrl@saveSpecIssueRecomm")->name('saveSpecIssueRecomm');

	Route::post('/update-recommendation', "RecommCtrl@updateRecomm")->name('updateRecomm');

	Route::get('/delete-recommendation/{id}', "RecommCtrl@deleteRecomm")->name('deleteRecomm')->where('id','[0-9]+');

});
//recommendation management end

//initiatives management start
Route::group([],function(){
	Route::get('/initiatives',"Initiatives@getRecomm")->name('getInitiative');
	
	Route::post('/save-recommendation', "RecommCtrl@saveRecomm")->name('saveRecomm');

	Route::post('/update-recommendation', "RecommCtrl@updateRecomm")->name('updateRecomm');

	Route::get('/delete-recommendation/{id}', "RecommCtrl@deleteRecomm")->name('deleteRecomm')->where('id','[0-9]+');

});
//initiatives management end

//videos or essay management start
Route::group([],function(){
	Route::get('/videos',"VideosCtrl@getVideos")->name('getVideos');
	Route::post('/save-video',"VideosCtrl@saveVideo")->name('saveVideo');
	
	Route::get('/delete-video/{id}', "VideosCtrl@deleteVideo")->name('deleteVideo')->where('id','[0-9]+');

});
//videos or essay management start
//Region management start
Route::group([],function(){
	Route::get('/locations',"RegionsCtrl@getLocations")->name('getLocations');
	
	Route::post('/save-location', "RegionsCtrl@saveLocation")->name('saveLocation');
	Route::post('/save-specific-location', "RegionsCtrl@saveSpecificLocation")->name('saveSpecificLocation');

	Route::post('/update-location', "RegionsCtrl@updateLocation")->name('updateLocation');

	Route::get('/delete-location/{id}', "RegionsCtrl@deleteLocation")->name('deleteLocation')->where('id','[0-9]+');
	Route::get('/search-region/{location}', "RegionsCtrl@searchRegion")->name('searchRegion');

});
//Region management end

//interest management start
Route::group([],function(){
	Route::get('/interest',"InterestCtrl@getInterest")->name('getInterest');

	Route::get('/search-interest/{interest}', "InterestCtrl@searchInterest")->name('searchInterest');
	
	Route::post('/save-interest', "InterestCtrl@saveInterest")->name('saveInterest');

	Route::post('/update-interest', "InterestCtrl@updateInterest")->name('updateLocation');

	Route::get('/delete-interest/{id}', "InterestCtrl@deleteInterest")->name('deleteLocation')->where('id','[0-9]+');

});
//Locations management end

//worklog operation
Route::get('/work-log', 'HomeController@workLog')->name('workLog');
Route::post('/save-worklog', 'HomeController@saveWorklog');
Route::post('/update','HomeController@updateWorklog')->name('updateForm');
Route::get('/delete/{id}',"HomeController@deleteWorklog")->name('delete');
Route::get('/pdf',"HomeController@downloadPDF")->name('pdf');
//worklog operation
//settings start
Route::Group([],function(){
	Route::get('setting',"HomeController@setting")->name('setting');
	Route::get('change-password',"HomeController@changePassword")->name('changePassword');
	Route::post('update-account',"HomeController@updateAccount")->name('updateAccount');
	Route::post('update-password',"HomeController@updatePassword")->name('updatePassword');
});
//settings end

//public users route start
Route::group([],function(){
	Route::get('/search-int-public/{interest}',"VisitorsCtrl@searchInterestPublic")->name('searchInterestPublic');
});
//public users route end

//rating routes for users
Route::group([''], function(){

	Route::post('/post-rating',"RatingCtrl@createRating")->name('createRating');
});
//rating routes end