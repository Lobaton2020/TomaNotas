<div id="response-ajax-main"></div>
<div id="response-ajax-keyup"></div>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <?php $domain = "http://localhost/TomaNotas_Version_Estable/"; ?>
            <?php if (isset($_GET["page"])) :
                if ($_GET["page"] > 1) :
                    $prev = $_GET["page"] - 1;
            ?>
                    <a class="page-link" href="<?php echo $domain . "?c=link&page={$prev}" ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </li>
        <li class="page-item">
            <?php if (isset($_GET["page"])) :
                if ($_GET["page"] > 0) :
                    $next = intval($_GET["page"]) + 1;
            ?>
                    <a class="page-link" href="<?php echo $domain . "?c=link&page={$next}" ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
            <?php if (!isset($_GET["page"])) : ?>
                <a class="page-link" href="<?php echo $domain . "?c=link&page=2" ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>

            <?php endif; ?>


        </li>
    </ul>
</nav>