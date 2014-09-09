<?php namespace Bolsa\Presenters;

/**
 * Class LinksPaginatorPresenter
 * @package Bolsa\Presenters
 */
class LinksPaginatorPresenter extends \Illuminate\Pagination\Presenter {

    /**
     * Get HTML wrapper for a page link.
     *
     * @param  string $url
     * @param  int $page
     * @return string
     */
    public function getPageLinkWrapper($url, $page)
    {
        return '<li class="pagina clearfix"><a class="enlace-pagina" href="'.$url.'">'.$page.'</a></li>';
    }

    /**
     * Get HTML wrapper for disabled text.
     *
     * @param  string $text
     * @return string
     */
    public function getDisabledTextWrapper($text)
    {
        return '<li class="pagina clearfix"><span class="_text">'.$text.'</span></li>';
    }

    /**
     * Get HTML wrapper for active text.
     *
     * @param  string $text
     * @return string
     */
    public function getActivePageWrapper($text)
    {
        return '<li class="pagina clearfix"><span class="_text">'.$text.'</span></li>';
    }
}