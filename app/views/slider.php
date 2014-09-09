<?php
    $presenter = new Bolsa\Presenters\LinksPaginatorPresenter($paginator);
?>

<?php if ($paginator->getLastPage() > 1): ?>
    <div class="pagination clearfix">
        <ul class="paginacion clearfix">
            <?php echo $presenter->render(); ?>
        </ul>
    </div>
<?php endif; ?>