<?php 

/* Frontpage shortcode */
function display_documents() { ?>

    <div class="alfresco-search-box">
        <h3>Pretraživanje priloga / Find articles</h3>
        <form id="searchform" enctype="multipart/form-data" method="post" action="<?php echo plugin_dir_url( __FILE__ ); ?>alfresco-search.php" target="my_iframe">
            <input id="searchTextId" class="inputtext" placeholder="Unesite pojam za pretraživanje..." name="searchText" type="text" />
            <select class="selectyear" name="selectYear">
                <option value="">Sve godine / All years</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
                <option value="2017">2017</option>
                <option value="2016">2016</option>
                <option value="2015">2015</option>
                <option value="2014">2014</option>
                <option value="2013">2013</option>
                <option value="2012">2012</option>
                <option value="2011">2011</option>
                <option value="2010">2010</option>
                <option value="2009">2009</option>
                <option value="2008">2008</option>
                <option value="2007">2007</option>
                <option value="2006">2006</option>
            </select>
            <input id="trazibtn" class="inputbutton" type="submit" value="Pretraži" onclick="pretraziClick()" />
            <input id="closebtn" class="closebutton" type="submit" value="Obriši" onclick="obrisiClick()" />
        </form>

        <script>
        function autoResize(id){
            document.getElementById(id).height = "0px"
            var newheight = document.getElementById(id).contentWindow.document.body.scrollHeight;
            document.getElementById(id).height = newheight + "px";
        }
        function pretraziClick() {
            if (document.getElementById("searchTextId").value) {
                document.getElementById("closebtn").style.display = "inline-block";
            }
        }
        function obrisiClick() {
            document.getElementById("closebtn").style.display = "none";
            document.getElementById("searchform").reset();
        }
        </script>

        <iframe name="my_iframe" src="<?php echo plugin_dir_url( __FILE__ ); ?>alfresco-search.php" width="100%" height="0px" id="iframe1" marginheight="0" frameborder="0" onLoad="autoResize('iframe1');"></iframe>
    </div>

<?php }
add_shortcode('alfresco-search', 'display_documents');

?>
