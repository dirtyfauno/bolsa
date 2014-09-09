<?php

/**
 * Class HomeController
 */
class HomeController extends BaseController {

    /**
     * @return \Illuminate\View\View
     */
    public function showWelcome()
	{
		return View::make('hello');
	}

}