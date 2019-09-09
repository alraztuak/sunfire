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

Route::get('/', 'WelcomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::group(array('prefix' => 'json'), function()
{
    Route::get('/dataKursBi', 'Xsim\KursBiXsim@dataKursBi')->middleware('auth');
    Route::get('/trashedKursBi', 'Xsim\KursBiXsim@trashedKursBi')->middleware('auth');
    Route::get('/dataKursMk', 'Xsim\KursMkXsim@dataKursMk')->middleware('auth');
    Route::get('/trashedKursMk', 'Xsim\KursMkXsim@trashedKursMk')->middleware('auth');
    Route::get('/dataKursKode', 'Xsim\KursKodeXsim@dataKursKode')->middleware('auth');
    Route::get('/dataKpp', 'Xsim\KppXsim@dataKpp')->middleware('auth');
    Route::get('/trashedKpp', 'Xsim\KppXsim@trashedKpp')->middleware('auth');
    Route::get('/dataKppJenis', 'Xsim\KppJenisXsim@dataKppJenis')->middleware('auth');
    Route::get('/dataTreaty', 'Xsim\TreatyXsim@dataTreaty')->middleware('auth');
    Route::get('/trashedTreaty', 'Xsim\TreatyXsim@trashedTreaty')->middleware('auth');
    Route::get('/dataTreatyJenis', 'Xsim\TreatyJenisXsim@dataTreatyJenis')->middleware('auth');
    Route::get('/dataTreatyInfo', 'Xsim\TreatyInfoXsim@dataTreatyInfo')->middleware('auth');
    Route::get('/trashedTreatyInfo', 'Xsim\TreatyInfoXsim@trashedTreatyInfo')->middleware('auth');
    Route::get('/dataPutusan', 'Xsim\PutusanXsim@dataPutusan')->middleware('auth');
    Route::get('/trashedPutusan', 'Xsim\PutusanXsim@trashedPutusan')->middleware('auth');
    Route::get('/dataPutusanCat', 'Xsim\PutusanCatXsim@dataPutusanCat')->middleware('auth');
    Route::get('/dataContent', 'Xsim\ContentXsim@dataContent')->middleware('auth');
    Route::get('/trashedContent', 'Xsim\ContentXsim@trashedContent')->middleware('auth');
    Route::get('/dataContentCat', 'Xsim\ContentCatXsim@dataContentCat')->middleware('auth');
    Route::get('/dataTag', 'Xsim\TagXsim@dataTag')->middleware('auth');
    Route::get('/dataHighlight', 'Xsim\HighlightXsim@dataHighlight')->middleware('auth');
    Route::get('/trashedHighlight', 'Xsim\HighlightXsim@trashedHighlight')->middleware('auth');
    Route::get('/dataTrending', 'Xsim\TrendingXsim@dataTrending')->middleware('auth');
    Route::get('/trashedTrending', 'Xsim\TrendingXsim@trashedTrending')->middleware('auth');
    Route::get('/dataAturan', 'Xsim\AturanXsim@dataAturan')->middleware('auth');
    Route::get('/trashedAturan', 'Xsim\AturanXsim@trashedAturan')->middleware('auth');
    Route::get('/dataAturanInfo', 'Xsim\AturanInfoXsim@dataAturanInfo')->middleware('auth');
    Route::get('/trashedAturanInfo', 'Xsim\AturanInfoXsim@trashedAturanInfo')->middleware('auth');
    Route::get('/dataAturanJenis', 'Xsim\AturanJenisXsim@dataAturanJenis')->middleware('auth');
    Route::get('/trashedAturanJenis', 'Xsim\AturanJenisXsim@trashedAturanJenis')->middleware('auth');
    Route::get('/dataAturanTopik', 'Xsim\AturanTopikXsim@dataAturanTopik')->middleware('auth');
    Route::get('/trashedAturanTopik', 'Xsim\AturanTopikXsim@trashedAturanTopik')->middleware('auth');
});

Route::prefix('xsim')->group(function () {
    Route::middleware(['auth'])->group(function()
    {
        Route::prefix('contentxsim')->group(function () {
            Route::get('/{site}/highlight', ['as' => 'contentxsim.highlight', 'uses' => 'Xsim\ContentXsim@highlight']);
            Route::get('/{site}/complete', ['as' => 'contentxsim.complete', 'uses' => 'Xsim\ContentXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'contentxsim.uncomplete', 'uses' => 'Xsim\ContentXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'contentxsim.delete', 'uses' => 'Xsim\ContentXsim@delete']);
            Route::get('/{site}/force', ['as' => 'contentxsim.force', 'uses' => 'Xsim\ContentXsim@destroy']);
            Route::get('/trashed', ['as' => 'contentxsim.trashed', 'uses' => 'Xsim\ContentXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'contentxsim.restore', 'uses' => 'Xsim\ContentXsim@restore']);
        });
        Route::prefix('contentcatxsim')->group(function () {
            Route::get('/{site}/force', ['as' => 'contentcatxsim.force', 'uses' => 'Xsim\ContentCatXsim@destroy']);
            Route::get('/{site}/complete', ['as' => 'contentcatxsim.complete', 'uses' => 'Xsim\ContentCatXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'contentcatxsim.uncomplete', 'uses' => 'Xsim\ContentCatXsim@uncomplete']);
        });
        Route::prefix('tagxsim')->group(function () {
            Route::get('/{site}/force', ['as' => 'tagxsim.force', 'uses' => 'Xsim\TagXsim@destroy']);
            Route::get('/{site}/complete', ['as' => 'tagxsim.complete', 'uses' => 'Xsim\TagXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'tagxsim.uncomplete', 'uses' => 'Xsim\TagXsim@uncomplete']);
        });
        Route::prefix('highlightxsim')->group(function () {
            Route::get('/{site}/complete', ['as' => 'highlightxsim.complete', 'uses' => 'Xsim\HighlightXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'highlightxsim.uncomplete', 'uses' => 'Xsim\HighlightXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'highlightxsim.delete', 'uses' => 'Xsim\HighlightXsim@delete']);
            Route::get('/{site}/force', ['as' => 'highlightxsim.force', 'uses' => 'Xsim\HighlightXsim@destroy']);
            Route::get('/trashed', ['as' => 'highlightxsim.trashed', 'uses' => 'Xsim\HighlightXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'highlightxsim.restore', 'uses' => 'Xsim\HighlightXsim@restore']);
        });
        Route::prefix('trendingxsim')->group(function () {
            Route::get('/{site}/complete', ['as' => 'trendingxsim.complete', 'uses' => 'Xsim\TrendingXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'trendingxsim.uncomplete', 'uses' => 'Xsim\TrendingXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'trendingxsim.delete', 'uses' => 'Xsim\TrendingXsim@delete']);
            Route::get('/{site}/force', ['as' => 'trendingxsim.force', 'uses' => 'Xsim\TrendingXsim@destroy']);
            Route::get('/trashed', ['as' => 'trendingxsim.trashed', 'uses' => 'Xsim\TrendingXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'trendingxsim.restore', 'uses' => 'Xsim\TrendingXsim@restore']);
        });
        Route::prefix('aturanxsim')->group(function () {
            Route::get('/{site}/link', ['as' => 'aturanxsim.link', 'uses' => 'Xsim\AturanXsim@link']);
            Route::get('/{site}/addterkait/{id}', ['as' => 'aturanxsim.addterkait', 'uses' => 'Xsim\AturanXsim@addterkait']);
            Route::get('/{site}/addstatus/{id}', ['as' => 'aturanxsim.addstatus', 'uses' => 'Xsim\AturanXsim@addstatus']);
            Route::get('/{site}/addhistori/{id}', ['as' => 'aturanxsim.addhistori', 'uses' => 'Xsim\AturanXsim@addhistori']);
            Route::get('/{site}/delterkait/{id}', ['as' => 'aturanxsim.delterkait', 'uses' => 'Xsim\AturanXsim@delterkait']);
            Route::get('/{site}/delstatus/{id}', ['as' => 'aturanxsim.delstatus', 'uses' => 'Xsim\AturanXsim@delstatus']);
            Route::get('/{site}/delhistori/{id}', ['as' => 'aturanxsim.delhistori', 'uses' => 'Xsim\AturanXsim@delhistori']);
            Route::get('/{site}/complete', ['as' => 'aturanxsim.complete', 'uses' => 'Xsim\AturanXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'aturanxsim.uncomplete', 'uses' => 'Xsim\AturanXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'aturanxsim.delete', 'uses' => 'Xsim\AturanXsim@delete']);
            Route::get('/{site}/force', ['as' => 'aturanxsim.force', 'uses' => 'Xsim\AturanXsim@destroy']);
            Route::get('/trashed', ['as' => 'aturanxsim.trashed', 'uses' => 'Xsim\AturanXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'aturanxsim.restore', 'uses' => 'Xsim\AturanXsim@restore']);
        });
        Route::prefix('aturantopikxsim')->group(function () {
            Route::get('/{site}/force', ['as' => 'aturantopikxsim.force', 'uses' => 'Xsim\AturanTopikXsim@destroy']);
            Route::get('/{site}/complete', ['as' => 'aturantopikxsim.complete', 'uses' => 'Xsim\AturanTopikXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'aturantopikxsim.uncomplete', 'uses' => 'Xsim\AturanTopikXsim@uncomplete']);
        });
        Route::prefix('aturaninfoxsim')->group(function () {
            Route::get('/{site}/force', ['as' => 'aturaninfoxsim.force', 'uses' => 'Xsim\AturanInfoXsim@destroy']);
            Route::get('/{site}/complete', ['as' => 'aturaninfoxsim.complete', 'uses' => 'Xsim\AturanInfoXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'aturaninfoxsim.uncomplete', 'uses' => 'Xsim\AturanInfoXsim@uncomplete']);
        });
        Route::prefix('aturanjenisxsim')->group(function () {
            Route::get('/{site}/force', ['as' => 'aturanjenisxsim.force', 'uses' => 'Xsim\AturanJenisXsim@destroy']);
            Route::get('/{site}/complete', ['as' => 'aturanjenisxsim.complete', 'uses' => 'Xsim\AturanJenisXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'aturanjenisxsim.uncomplete', 'uses' => 'Xsim\AturanJenisXsim@uncomplete']);
        });
        Route::prefix('putusanxsim')->group(function () {
            Route::get('/{site}/highlight', ['as' => 'putusanxsim.highlight', 'uses' => 'Xsim\PutusanXsim@highlight']);
            Route::get('/{site}/complete', ['as' => 'putusanxsim.complete', 'uses' => 'Xsim\PutusanXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'putusanxsim.uncomplete', 'uses' => 'Xsim\PutusanXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'putusanxsim.delete', 'uses' => 'Xsim\PutusanXsim@delete']);
            Route::get('/{site}/force', ['as' => 'putusanxsim.force', 'uses' => 'Xsim\PutusanXsim@destroy']);
            Route::get('/trashed', ['as' => 'putusanxsim.trashed', 'uses' => 'Xsim\PutusanXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'putusanxsim.restore', 'uses' => 'Xsim\PutusanXsim@restore']);
        });
        Route::prefix('putusancatxsim')->group(function () {
            Route::get('/{site}/force', ['as' => 'putusancatxsim.force', 'uses' => 'Xsim\PutusanCatXsim@destroy']);
            Route::get('/{site}/complete', ['as' => 'putusancatxsim.complete', 'uses' => 'Xsim\PutusanCatXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'putusancatxsim.uncomplete', 'uses' => 'Xsim\PutusanCatXsim@uncomplete']);
        });
        Route::prefix('treatyxsim')->group(function () {
            Route::get('/{site}/complete', ['as' => 'treatyxsim.complete', 'uses' => 'Xsim\TreatyXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'treatyxsim.uncomplete', 'uses' => 'Xsim\TreatyXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'treatyxsim.delete', 'uses' => 'Xsim\TreatyXsim@delete']);
            Route::get('/{site}/force', ['as' => 'treatyxsim.force', 'uses' => 'Xsim\TreatyXsim@destroy']);
            Route::get('/trashed', ['as' => 'treatyxsim.trashed', 'uses' => 'Xsim\TreatyXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'treatyxsim.restore', 'uses' => 'Xsim\TreatyXsim@restore']);
        });
        Route::prefix('treatyjenisxsim')->group(function () {
            Route::get('/{site}/force', ['as' => 'treatyjenisxsim.force', 'uses' => 'Xsim\TreatyJenisXsim@destroy']);
            Route::get('/{site}/complete', ['as' => 'treatyjenisxsim.complete', 'uses' => 'Xsim\TreatyJenisXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'treatyjenisxsim.uncomplete', 'uses' => 'Xsim\TreatyJenisXsim@uncomplete']);
        });   
        Route::prefix('treatyinfoxsim')->group(function () {
            Route::get('/{site}/complete', ['as' => 'treatyinfoxsim.complete', 'uses' => 'Xsim\TreatyInfoXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'treatyinfoxsim.uncomplete', 'uses' => 'Xsim\TreatyInfoXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'treatyinfoxsim.delete', 'uses' => 'Xsim\TreatyInfoXsim@delete']);
            Route::get('/{site}/force', ['as' => 'treatyinfoxsim.force', 'uses' => 'Xsim\TreatyInfoXsim@destroy']);
            Route::get('/trashed', ['as' => 'treatyinfoxsim.trashed', 'uses' => 'Xsim\TreatyInfoXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'treatyinfoxsim.restore', 'uses' => 'Xsim\TreatyInfoXsim@restore']);
        });
        Route::prefix('kppxsim')->group(function () {
            Route::get('/{site}/complete', ['as' => 'kppxsim.complete', 'uses' => 'Xsim\KppXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'kppxsim.uncomplete', 'uses' => 'Xsim\KppXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'kppxsim.delete', 'uses' => 'Xsim\KppXsim@delete']);
            Route::get('/{site}/force', ['as' => 'kppxsim.force', 'uses' => 'Xsim\KppXsim@destroy']);
            Route::get('/trashed', ['as' => 'kppxsim.trashed', 'uses' => 'Xsim\KppXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'kppxsim.restore', 'uses' => 'Xsim\KppXsim@restore']);
        });
        Route::prefix('kppjenisxsim')->group(function () {
            Route::get('/{site}/force', ['as' => 'kppjenisxsim.force', 'uses' => 'Xsim\KppJenisXsim@destroy']);
            Route::get('/{site}/complete', ['as' => 'kppjenisxsim.complete', 'uses' => 'Xsim\KppJenisXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'kppjenisxsim.uncomplete', 'uses' => 'Xsim\KppJenisXsim@uncomplete']);
        });  
        Route::prefix('kurskodexsim')->group(function () {
            Route::get('/{site}/force', ['as' => 'kurskodexsim.force', 'uses' => 'Xsim\KursKodeXsim@destroy']);
            Route::get('/{site}/complete', ['as' => 'kurskodexsim.complete', 'uses' => 'Xsim\KursKodeXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'kurskodexsim.uncomplete', 'uses' => 'Xsim\KursKodeXsim@uncomplete']);
        });
        Route::prefix('kursmkxsim')->group(function () {
            Route::get('/{site}/complete', ['as' => 'kursmkxsim.complete', 'uses' => 'Xsim\KursMkXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'kursmkxsim.uncomplete', 'uses' => 'Xsim\KursMkXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'kursmkxsim.delete', 'uses' => 'Xsim\KursMkXsim@delete']);
            Route::get('/{site}/force', ['as' => 'kursmkxsim.force', 'uses' => 'Xsim\KursMkXsim@destroy']);
            Route::get('/trashed', ['as' => 'kursmkxsim.trashed', 'uses' => 'Xsim\KursMkXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'kursmkxsim.restore', 'uses' => 'Xsim\KursMkXsim@restore']);
        });  
        Route::prefix('kursbixsim')->group(function () {
            Route::get('/{site}/complete', ['as' => 'kursbixsim.complete', 'uses' => 'Xsim\KursBiXsim@complete']);
            Route::get('/{site}/uncomplete', ['as' => 'kursbixsim.uncomplete', 'uses' => 'Xsim\KursBiXsim@uncomplete']);
            Route::get('/{site}/delete', ['as' => 'kursbixsim.delete', 'uses' => 'Xsim\KursBiXsim@delete']);
            Route::get('/{site}/force', ['as' => 'kursbixsim.force', 'uses' => 'Xsim\KursBiXsim@destroy']);
            Route::get('/trashed', ['as' => 'kursbixsim.trashed', 'uses' => 'Xsim\KursBiXsim@trashed']);
            Route::get('/{site}/restore', ['as' => 'kursbixsim.restore', 'uses' => 'Xsim\KursBiXsim@restore']);
        });  
            Route::resource('/kursbixsim','Xsim\kursbixsim');
            Route::resource('/kursmkxsim','Xsim\kursmkxsim');
            Route::resource('/kurskodexsim','Xsim\kurskodexsim');
            Route::resource('/kppxsim','Xsim\kppxsim');
            Route::resource('/kppjenisxsim','Xsim\kppjenisxsim');
            Route::resource('/treatyxsim','Xsim\treatyxsim');
            Route::resource('/treatyjenisxsim','Xsim\treatyjenisxsim');
            Route::resource('/treatyinfoxsim','Xsim\treatyinfoxsim');
            Route::resource('/putusanxsim','Xsim\putusanxsim');
            Route::resource('/putusancatxsim','Xsim\putusancatxsim');
            Route::resource('/aturanxsim','Xsim\aturanxsim');
            Route::resource('/aturaninfoxsim','Xsim\aturaninfoxsim');
            Route::resource('/aturantopikxsim','Xsim\aturantopikxsim');
            Route::resource('/aturanjenisxsim','Xsim\aturanjenisxsim');
            Route::resource('/contentxsim','Xsim\contentxsim');
            Route::resource('/contentcatxsim','Xsim\contentcatxsim');
            Route::resource('/tagxsim','Xsim\tagxsim');
            Route::resource('/highlightxsim','Xsim\highlightxsim');
            Route::resource('/trendingxsim','Xsim\trendingxsim');
    });
});

Route::group(array('prefix' => 'ortax'), function()
{   
    Route::group(array('prefix' => 'aturan'), function()
    {
        Route::get('list', ['as' => 'aturanortax.list', 'uses' => 'Ortax\AturanOrtax@list']);
        Route::get('show/{id}', ['as' => 'aturanortax.show', 'uses' => 'Ortax\AturanOrtax@show']);
    });
    Route::group(array('prefix' => 'putusan'), function()
    {
        Route::get('list', ['as' => 'putusanortax.list', 'uses' => 'Ortax\PutusanOrtax@list']);
        Route::get('show/{id}', ['as' => 'putusanortax.show', 'uses' => 'Ortax\PutusanOrtax@show']);
    });
    Route::group(array('prefix' => 'treaty'), function()
    {
        Route::get('list', ['as' => 'treatyortax.list', 'uses' => 'Ortax\TreatyOrtax@list']);
        Route::get('show/{id}', ['as' => 'treatyortax.show', 'uses' => 'Ortax\TreatyOrtax@show']);
    });
    Route::group(array('prefix' => 'kpp'), function()
    {
        Route::get('list', ['as' => 'kpportax.list', 'uses' => 'Ortax\KppOrtax@list']);
        Route::get('show/{id}', ['as' => 'kpportax.show', 'uses' => 'Ortax\KppOrtax@show']);
    });
    Route::get('trending/list/{id}', ['as' => 'trendingortax.list', 'uses' => 'Ortax\TrendingOrtax@list']);
    Route::get('tag/list/{id}', ['as' => 'tagortax.list', 'uses' => 'Ortax\TagOrtax@list']);
    Route::get('highlight/list', ['as' => 'highlightortax.list', 'uses' => 'Ortax\HighlightOrtax@list']);
    Route::get('{param}/list', ['as' => 'contentortax.list', 'uses' => 'Ortax\ContentOrtax@list']);
    Route::get('{param}/show/{id}', ['as' => 'contentortax.show', 'uses' => 'Ortax\ContentOrtax@show']);
});