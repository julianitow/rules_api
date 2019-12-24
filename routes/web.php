<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});


/**
 * Prefix URL with 'domain/api'
 */
$router->group(['prefix' => 'api'], function() use ($router){

    /********************* RULE PART *******************************/
    /**
     * GET
     * Get all rules in DB
     */
    $router->get('rules', ['uses' => 'RuleController@showAllRules']);

    /**
     * POST
     * Create new rule
     */
    $router->post('rules', ['uses' => 'RuleController@create']);

    /**
     * PUT
     * Update rule identified by 'id'
     */
    $router->put('rule/{id}', ['uses' => 'RuleController@update']); 

    /**
     * DELETE
     * Delete rule identified by 'id'
     */
    $router->delete('rule/{id}', ['uses' => 'RuleController@delete']);

    /********************* CATEGORIES PART  ********************************/

    /**
     * GET
     * Get all rules authors
     */
    $router->get('categories', ['uses' => 'CategoryController@showAllCategories']);

    /**
     * GET
     * Get author identified by 'id'
     */
    $router->get('category/{id}', ['uses' => 'CategoryController@showCategory']);

    /**
     * PUT
     * Update author identified by 'id'
     */
    $router->put('category/{id}', ['uses' => 'CategoryController@update']);

    /**
     * POST
     * Create new author
     */
    $router->post('categories', ['uses' => 'CategoryController@create']);

    /**
     * PUT
     * DELETE author identified by 'id'
     */
    $router->delete('category/{id}', ['uses' => 'CategoryController@delete']); 

    /********************* AUHTORS PART *************************************/
    /**
     * GET
     * Get all rules authors
     */
    $router->get('authors', ['uses' => 'AuthorController@showAllAuthors']);

    /**
     * GET
     * Get author identified by 'id'
     */
    $router->get('author/{id}', ['uses' => 'AuthorController@showAuthor']);

    /**
     * PUT
     * Update author identified by 'id'
     */
    $router->put('author/{id}', ['uses' => 'AuthorController@update']);

    /**
     * POST
     * Create new author
     */
    $router->post('authors', ['uses' => 'AuthorController@create']);

    /**
     * PUT
     * DELETE author identified by 'id'
     */
    $router->delete('author/{id}', ['uses' => 'AuthorController@delete']); 

    /**
     * TODO: 
     * GET ALL RULES BY CATEGORIES
     * GET ALL RULES BY AUTHOR
     * GET RULE BY ID
     * 
     * DELETE RULE
     * UPDATE RULE
     * CREATE RULE
     */
});
