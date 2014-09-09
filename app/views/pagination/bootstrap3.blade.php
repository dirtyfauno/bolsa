<div class="text-center">
    <ul class="pagination">
        <?php use Bolsa\Presenters\Bootstrap3PaginatorPresenter;

        echo with(new Bootstrap3PaginatorPresenter($paginator))->render(); ?>
    </ul>
</div>