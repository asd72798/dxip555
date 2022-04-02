<?php if ($data['setting']['icp']) { ?>
    <div style=""></div>
    <footer id="footer">
        <div class="footer-bottom">
            <div class="container">
                <div class="row copyright">
                    <?php echo $data['setting']['icp']; ?>
                </div>
            </div>
        </div>
    </footer>
</div>
<?php } ?>
<!--start::HOOK-->
<?php hook(\App\Consts\Hook::USER_VIEW_INDEX_BODY); ?>
<!--end::HOOK-->
</body>
<!--start::HOOK-->
<?php hook(\App\Consts\Hook::USER_VIEW_INDEX_FOOTER); ?>
<!--end::HOOK-->

</html>