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

Route::get('/', 'HomeController@index')->name('mainhome')->middleware('twofactor');

Auth::routes();

Route::get('/redirect','SocialController@redirect')->name('redirect');
Route::get('/callback','SocialController@callback');

Route::get('/redirectToFB','SocialController@redirectToFB')->name('redirectToFB');
Route::get('/callbackToFB','SocialController@callbackToFB');

Route::get('/redirectToTwitter','SocialController@redirectToTwitter')->name('redirectToTwitter');
Route::get('/callbackToTwitter','SocialController@callbackToTwitter');

Route::post('/paytm-callback','Author\AdsPostController@paytmCallback');


Route::get('verify/resend', 'Auth\TwoFactorController@resend')->name('verify.resend');
Route::resource('verify', 'Auth\TwoFactorController')->only(['index', 'store']);

Route::group([ 'as' => 'admin.','prefix' => 'admin','namespace' => 'Admin', 'middleware' => ['auth','admin','twofactor']],
function()
{
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('tag','TagController');
    Route::resource('category','CategoryController');
    Route::resource('post','PostController');

    // Route::get('/tag/{id}', 'TagController@destroy')->name('tag.delete');

    Route::get('pending/post','PostController@pending')->name('post.pending');
    Route::put('pots/{id}/approve','PostController@approval')->name('post.approve');

    Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{subscriber}','SubscriberController@destroy')->name('subscriber.destroy');

    Route::get('/favourite','FavouriteController@index')->name('favourite.index');

    Route::get('comments/','CommentController@index')->name('comment.index');
    Route::delete('comment/{id}','CommentController@destroy')->name('comment.destroy');

    Route::get('authors','AuthorController@index')->name('author.index');
    Route::delete('authors/{id}','AuthorController@destroy')->name('author.destroy');

    Route::get('settings','SettingController@index')->name('setting');
    Route::put('profile-update','SettingController@updateProfile')->name('profile.update');

    Route::get('password-change','SettingController@password_index')->name('password.index');
    Route::put('password-update','SettingController@password_update')->name('password.update');

    Route::get('follower','FollowshipController@follow_index')->name('follower.index');
    Route::get('following','FollowshipController@following_index')->name('following.index');

    Route::resource('ads','AdsOfferController');
    Route::resource('adv_post','AdsPostController')->only(['index','destroy']);
});


Route::group([ 'as' => 'author.', 'prefix' => 'author','namespace' => 'Author', 'middleware' => ['auth','author','twofactor']],
function()
{
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::resource('post','PostController');
    Route::resource('tag','TagController');

    Route::get('/favourite','FavouriteController@index')->name('favourite.index');

    Route::get('settings','SettingController@index')->name('setting');
    Route::put('profile-update','SettingController@updateProfile')->name('profile.update');

    Route::get('comments/','CommentController@index')->name('comment.index');
    Route::delete('comment/{id}','CommentController@destroy')->name('comment.destroy');

    Route::get('password-change','SettingController@password_index')->name('password.index');
    Route::put('password-update','SettingController@password_update')->name('password.update');

    Route::get('follower','FollowshipController@follow_index')->name('follower.index');
    Route::get('following','FollowshipController@following_index')->name('following.index');

    Route::resource('ads','AdsPostController');
    Route::get('/pay/{id}','AdsPostController@payNow')->name('paynow');
    
});

Route::group(['middleware'=> ['auth','twofactor']],function(){

    Route::post('favourite/{id}/add','FavouriteController@add')->name('post.favourite');

    Route::post('comment/{post}','CommentController@store')->name('comment.store');

    Route::get('userAction','FollowshipController@userAction')->name('userAction');

    Route::get('author/{username}','HomeController@profile')->name('profile.index');
    
    Route::get('/category/{slug}','PostController@postByCategory')->name('category.post');
    
    Route::get('/tag/{slug}','PostController@postByTag')->name('tag.post');

    Route::get('popular-author','HomeController@popularAuthor')->name('popular_author.index');
    
    Route::get('posts','PostController@index')->name('post.index');

    

});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::post('subscriber','SubscriberController@store')->name('subscriber.store');
Route::get('posts/{slug}','PostController@details')->name('post.details');
Route::get('/contact-us','HomeController@contact_us')->name('contact.index');
Route::post('contact-us/','HomeController@sendMail')->name('sendMail');
Route::get('/search','SearchController@postSearch')->name('search');
Route::get('/authorSearch','SearchController@authorSearch')->name('author_search');


View::composer('layouts.frontend.partial.footer',function($view){
    $tags = App\Tag::take(10)->latest()->get();
    $view->with('tags',$tags);
});
View::composer('layouts.frontend.partial.header',function($view){
    $categories = App\Category::all();
    $view->with('categories',$categories);
});
View::composer('layouts.frontend.partial.header_home',function($view){
    $categories = App\Category::all();
    $view->with('categories',$categories);
});
