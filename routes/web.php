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
    

    /**
     * Get all available categories
     */
    $router->get('categories', ['uses' => 'RuleController@showCategories']);

    /**
     * Get all rules authors
     */
    $router->get('authors', ['use' => 'RuleController@showAuthors']);

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
