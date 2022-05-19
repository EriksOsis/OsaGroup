<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CurrencyController extends CI_Controller
{
	public function index()
	{
		$this->load->view('calculator');
	}

	public function convertCurrency($amount, $from_currency, $to_currency): string
	{
		$total = 0;
		if ($amount && $from_currency && $to_currency) {
			$apikey = '400df89c9ea465ac6491';

			$from_Currency = urlencode(strtoupper($from_currency));
			$to_Currency = urlencode(strtoupper($to_currency));
			$query = "{$from_Currency}_{$to_Currency}";

			$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&apiKey={$apikey}");

			$obj = json_decode($json, true);

			$val = floatval($obj["$query"]);

			$total += $val * $amount;
		}

		return number_format($total, 2, '.', '');
	}

	public function show($from_currency, $to_currency, $date): float|string
	{
		if ($from_currency && $to_currency && $date) {
			$apikey = '400df89c9ea465ac6491';

			$from_Currency = urlencode($from_currency);
			$to_Currency = urlencode($to_currency);
			$query = "{$from_Currency}_{$to_Currency}";

			$json = file_get_contents("https://free.currconv.com/api/v7/convert?q={$query}&compact=ultra&date={$date}&apiKey={$apikey}");

			$obj = json_decode($json, true);

			foreach ($obj as $value) {
				foreach ($value as $key) {
					return number_format($key, 2, '.', '');
				}
			}
		}
		return "Enter values";
	}

//	public function list(): array
//	{
//		$apikey = '400df89c9ea465ac6491';
//
//		$json = file_get_contents("https://free.currconv.com/api/v7/currencies?apiKey={$apikey}");
//		$obj = json_decode($json, true);
//
//		foreach ($obj as $symbols) {
//				return array_keys($symbols);
//		}
//		return [];
//	}
}
