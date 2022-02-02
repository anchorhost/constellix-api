<?php

/**
 * Constellix API WordPress Wrapper
 *
 * See readme for setup and coding examples.
 *
 * @author   Austin Ginder <austin@anchor.host>
 */

function constellix_api_get( $command ) {

	$timestamp = round( microtime( true ) * 1000 );
	$hmac      = base64_encode( hash_hmac( 'sha1', $timestamp, CONSTELLIX_SECRET_KEY, true ) );
	$args      = [
		'timeout' => 120,
		'headers' => [
			'Content-type'         => 'application/json',
			'x-cnsdns-apiKey'      => CONSTELLIX_API_KEY,
			'x-cnsdns-hmac'        => $hmac,
			'x-cnsdns-requestDate' => $timestamp,
		],
	];
	$remote    = wp_remote_get( "https://api.dns.constellix.com/v1/$command/", $args );

	if ( is_wp_error( $remote ) ) {
		return $remote->get_error_message();
	} else {
		return json_decode( $remote['body'] );
	}

}

function constellix_api_post( $command, $post ) {

	$timestamp = round( microtime( true ) * 1000 );
	$hmac      = base64_encode( hash_hmac( 'sha1', $timestamp, CONSTELLIX_SECRET_KEY, true ) );
	$args      = [
		'timeout' => 120,
		'headers' => [
			'Content-type'         => 'application/json',
			'x-cnsdns-apiKey'      => CONSTELLIX_API_KEY,
			'x-cnsdns-hmac'        => $hmac,
			'x-cnsdns-requestDate' => $timestamp,
		],
		'body'    => json_encode( $post ),
		'method'  => 'POST',
	];
	$remote    = wp_remote_post( "https://api.dns.constellix.com/v1/$command/", $args );

	if ( is_wp_error( $remote ) ) {
		return $remote->get_error_message();
	} else {
		return json_decode( $remote['body'] );
	}

}

function constellix_api_put( $command, $post ) {

	$timestamp = round( microtime( true ) * 1000 );
	$hmac      = base64_encode( hash_hmac( 'sha1', $timestamp, CONSTELLIX_SECRET_KEY, true ) );
	$args      = [
		'timeout' => 120,
		'headers' => [
			'Content-type'         => 'application/json',
			'x-cnsdns-apiKey'      => CONSTELLIX_API_KEY,
			'x-cnsdns-hmac'        => $hmac,
			'x-cnsdns-requestDate' => $timestamp,
		],
		'body'    => json_encode( $post ),
		'method'  => 'PUT',
	];
	$remote    = wp_remote_post( "https://api.dns.constellix.com/v1/$command/", $args );

	if ( is_wp_error( $remote ) ) {
		return $remote->get_error_message();
	} else {
		return json_decode( $remote['body'] );
	}

}

function constellix_api_delete( $command ) {

	$timestamp = round( microtime( true ) * 1000 );
	$hmac      = base64_encode( hash_hmac( 'sha1', $timestamp, CONSTELLIX_SECRET_KEY, true ) );
	$args      = [
		'timeout' => 120,
		'headers' => [
			'Content-type'         => 'application/json',
			'x-cnsdns-apiKey'      => CONSTELLIX_API_KEY,
			'x-cnsdns-hmac'        => $hmac,
			'x-cnsdns-requestDate' => $timestamp,
		],
		'body'    => json_encode( $post ),
		'method'  => 'DELETE',
	];
	$remote    = wp_remote_post( "https://api.dns.constellix.com/v1/$command/", $args );

	if ( is_wp_error( $remote ) ) {
		return $remote->get_error_message();
	} else {
		return json_decode( $remote['body'] );
	}

}
