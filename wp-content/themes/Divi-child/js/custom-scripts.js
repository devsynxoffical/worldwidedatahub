jQuery(document).ready(function(){
  
    jQuery("#sms_integration_content").hide();
    jQuery("#sms_api_content").hide();
    jQuery("#sms_integration_btn").hide();
    jQuery("#api_sdk_btn").hide();
    jQuery("#sms_gateway").css({"cursor": "pointer"});
    jQuery("#sms_integration").css({"cursor": "pointer"});
    jQuery("#sms_api_sdk").css({"cursor": "pointer"});

    jQuery("#sms_gateway").click(function(){
    	jQuery("#sms_integration_content").hide();
    	jQuery("#sms_api_content").hide();
    	jQuery("#sms_gateway_content").show();
    	jQuery("#sms_gateway").css({"background-color": "#0a36ac","cursor":"pointer"});
    	jQuery("#sms_gateway span").css({"color": "#fff"});
    	jQuery("#sms_gateway .et_pb_blurb_description").css({"color": "#fff"});
    	jQuery("#sms_integration").css({"background-color": "#ffffff"});
    	jQuery("#sms_api_sdk").css({"background-color": "#ffffff"}); 

    	jQuery("#sms_integration span").css({"color": "#000"});
    	jQuery("#sms_integration .et_pb_blurb_description").css({"color": "#565b73"});
    	jQuery("#sms_api_sdk span").css({"color": "#000"});
    	jQuery("#sms_api_sdk .et_pb_blurb_description").css({"color": "#565b73"});

        jQuery("#sms_integration_btn").hide();
        jQuery("#api_sdk_btn").hide();
        jQuery("#sms_gatway_btn").show();

  	});
  	jQuery("#sms_integration").click(function(){
    	jQuery("#sms_integration_content").show();
    	jQuery("#sms_api_content").hide();
    	jQuery("#sms_gateway_content").hide();
    	jQuery("#sms_gateway").css({"background-color": "#ffffff"});
    	jQuery("#sms_integration").css({"background-color": "#0a36ac","cursor":"pointer"});
    	jQuery("#sms_integration span").css({"color": "#fff"});
    	jQuery("#sms_integration .et_pb_blurb_description").css({"color": "#fff"});
    	jQuery("#sms_api_sdk").css({"background-color": "#ffffff"});

    	jQuery("#sms_gateway span").css({"color": "#000"});
    	jQuery("#sms_gateway .et_pb_blurb_description").css({"color": "#565b73"});
    	jQuery("#sms_api_sdk span").css({"color": "#000"});
    	jQuery("#sms_api_sdk .et_pb_blurb_description").css({"color": "#565b73"});

        jQuery("#sms_integration_btn").show();
        jQuery("#sms_gatway_btn").hide();
        jQuery("#api_sdk_btn").hide();


  	});
  	jQuery("#sms_api_sdk").click(function(){
    	jQuery("#sms_integration_content").hide();
    	jQuery("#sms_api_content").show();
    	jQuery("#sms_gateway_content").hide();
    	jQuery("#sms_gateway").css({"background-color": "#ffffff"});
    	jQuery("#sms_integration").css({"background-color": "#ffffff"});
    	jQuery("#sms_api_sdk").css({"background-color": "#0a36ac","cursor":"pointer"});
    	jQuery("#sms_api_sdk span").css({"color": "#fff"});
    	jQuery("#sms_api_sdk .et_pb_blurb_description").css({"color": "#fff"});

    	jQuery("#sms_gateway span").css({"color": "#000"});
    	jQuery("#sms_gateway .et_pb_blurb_description").css({"color": "#565b73"});
    	jQuery("#sms_integration span").css({"color": "#000"});
    	jQuery("#sms_integration .et_pb_blurb_description").css({"color": "#565b73"});

        jQuery("#sms_integration_btn").hide();
        jQuery("#sms_gatway_btn").hide();
        jQuery("#api_sdk_btn").show();
  	});
  
  
});