            <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © 2019 <?php echo get_copyright(); ?>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?php echo base_url(). ASSETS_JS; ?>jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(). ASSETS_JS; ?>waves.js"></script>
    <script src="<?php echo base_url(). ASSETS_JS; ?>angular.min.js"></script>
    <!--Menu sidebar -->
    <script src="<?php echo base_url(). ASSETS_JS; ?>sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>sparkline/jquery.sparkline.min.js"></script>
    <!--stickey kit -->
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?php echo base_url(). ASSETS_JS; ?>custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!-- chartist chart -->
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>chartist-js/dist/chartist.min.js"></script>
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!--c3 JavaScript -->
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>d3/d3.min.js"></script>
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>c3-master/c3.min.js"></script>
    <!-- Vector map JavaScript -->
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>vectormap/jquery-jvectormap-us-aea-en.js"></script>
    <script src="js/dashboard2.js"></script>

    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="<?php echo base_url(). ASSETS_PLUGINS_JS; ?>styleswitcher/jQuery.style.switcher.js"></script>
    <!-- add other script -->
    <?php 
        if(isset($script)) {
            if(is_array($script)) {
                foreach($script as $src) {
                    echo "<script src='".base_url($src)."'></script>";
                }
            } else {
                echo "<script src='".base_url($script)."'></script>";
            }
        }
    ?>
</body>

</html>
