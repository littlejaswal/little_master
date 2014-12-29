<?php if(GOOGLE_AC!=''):?>
    <script type="text/javascript">
      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', '<?php echo GOOGLE_AC;?>']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();
    </script> 
<?php endif;?>

<?php if(GOOGLE_VC!=''):?>
    <meta name="google-site-verification" content="<?php echo GOOGLE_VC;?>">
<?php endif;?>


<?php if(BING_VC!=''):?>
    <meta name="msvalidate.01" content="<?php echo BING_VC?>" />
<?php endif;?>


<?php if(YAHOO_VC!=''):?>
    <meta name="y_key" content="<?php echo YAHOO_VC?>" /> 
<?php endif;?>
