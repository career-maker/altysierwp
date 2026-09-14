<?php
/**
 * Template Name: Group of Companies
 *
 * Redirects to homepage companies section (#companies) matching group-of-companies.html
 *
 * @package Altysier
 */

wp_safe_redirect( home_url( '/#companies' ), 301 );
exit;
