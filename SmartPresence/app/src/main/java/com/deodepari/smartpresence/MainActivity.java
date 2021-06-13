package com.deodepari.smartpresence;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuInflater;
import android.view.MenuItem;
import android.view.View;
import android.webkit.WebChromeClient;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toolbar;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;

import com.google.android.material.bottomnavigation.BottomNavigationView;
//import com.google.android.material.navigation.NavigationView;


public class MainActivity extends AppCompatActivity {
    //Webview
    private WebView webView;
    String url;
    private Object String;
    private Button button_top;

    //variables for detect finished webview
    private Context mContext;
    private String mURL;
    private Button mButton;
    private RelativeLayout mRelativeLayout;
    private TextView mTextView;
    private WebView mWebView;

    Toolbar toolbar;

    public Toolbar getNav(){
        return toolbar;
    }


    @Override
    protected void onCreate(Bundle savedInstanceState) {

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //get the application context
        mContext= getApplicationContext();

        //specify the url to surf
        mURL = "https://smartpresenceupnvj.my.id";

        // Get the widgets reference from XML layout
        mRelativeLayout = (RelativeLayout) findViewById(R.id.rl);
        //mTextView = (TextView) findViewById(R.id.tv);
        //mButton = (Button) findViewById(R.id.btn);
        mWebView = (WebView) findViewById(R.id.webview);

        //set a click listener for button widget


        //webview

        webView = (WebView) findViewById(R.id.webview);
        webView.setWebViewClient(new WebViewClient());
        //webView.loadUrl("http://192.168.100.2:8080/SmartPresence/public/login");
        webView.loadUrl("https://smartpresenceupnvj.my.id");

        onPageStarted(webView, url);
        WebSettings webSettings = webView.getSettings();
        webSettings.setJavaScriptEnabled(true);



        // you need to setWebViewClient for forcefully open in your webview
        /*
        webView.reload();
        if(webView.getUrl().equals("http://192.168.100.2:8080/SmartPresence/public/allclass")) {
            webView.reload();
            Log.d("myTag", webView.getUrl());
            Log.d("myTag", "Same URL");
        }
        else {
            //already log in
            webView.reload();
            Log.d("myTag",  webView.getUrl());
            Log.d("myTag", "Different URL");
        }

         */
        Log.d("myTag", webView.getUrl());
        //Webview

        //Bottom Navigation
        BottomNavigationView bottomNav = findViewById(R.id.bottom_navigation);
        bottomNav.setOnNavigationItemSelectedListener(navListener);

        getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container,
                new HomeFragment()).commit();

        //I added this if statement to keep the selected fragment when rotating the device
        if (savedInstanceState == null) {
            getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container,
                    new HomeFragment()).commit();
        }
        //Bottom Navigation

        //listen to the page changes
        mWebView.setWebChromeClient(new WebChromeClient(){
            public void onProgressChanged(WebView webView, int newProgress){
                if(newProgress == 100){
                    // Page loading finish
                    //Toast.makeText(mContext,"Page Loaded.",Toast.LENGTH_SHORT).show();
                    Log.d("CurrentPage", webView.getUrl());
                    if(webView.getUrl().equals("https://smartpresenceupnvj.my.id/login")){
                        new HomeFragment();
                        bottomNav.setVisibility(View.GONE);
                    }
                    else{
                        bottomNav.setVisibility(View.VISIBLE);
                    }


                }
            }
        });
        //listen to the page changes

        Log.d("myTag2", webView.getUrl());


    }


    //Webview

    @Override
    public void onBackPressed() {
        if (webView.canGoBack()) {
            webView.goBack();
        } else {
            super.onBackPressed();  
        }
    }

    //top menu
    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        MenuInflater inflate = getMenuInflater();
        inflate.inflate(R.menu.top_menu, menu);
        return true;
    }

    public boolean onOptionsItemSelected(@NonNull MenuItem item){
        switch (item.getItemId()) {
            case R.id.item1:
                Uri uri1 = Uri.parse("https://akademik.upnvj.ac.id/"); // missing 'http://' will cause crashed
                Intent intent1 = new Intent(Intent.ACTION_VIEW, uri1);
                startActivity(intent1);
                return true;



            case R.id.item2:
                Uri uri2 = Uri.parse("https://elearning40.upnvj.ac.id/"); // missing 'http://' will cause crashed
                Intent intent2 = new Intent(Intent.ACTION_VIEW, uri2);
                startActivity(intent2);
                return true;

            case R.id.item3:
                Intent intent3 = new Intent(this,AboutFragment.class);
                startActivity(intent3);
                return true;



            default:
                return super.onOptionsItemSelected(item);
        }
    }


    //top menu



    public void onPageStarted(WebView view, String url){
        Fragment selectedFragment = null;
        if(view.getUrl().equals("https://smartpresenceupnvj.my.id")){
            Log.d("onpagetag", webView.getUrl());
            selectedFragment = new HomeFragment();
            webView.loadUrl("https://smartpresenceupnvj.my.id");
        }

    }



    //Webview


    //Bottom Navigation
    private BottomNavigationView.OnNavigationItemSelectedListener navListener =
            new BottomNavigationView.OnNavigationItemSelectedListener() {
                @Override
                public boolean onNavigationItemSelected(@NonNull MenuItem item) {
                    Fragment selectedFragment = null;


                    switch (item.getItemId()) {
                        case R.id.nav_home:
                            Log.d("myTag3", webView.getUrl());
                            selectedFragment = new HomeFragment();
                            webView.loadUrl("https://smartpresenceupnvj.my.id");
                            break;

                        case R.id.nav_allclass:
                            Log.d("myTag3", webView.getUrl());
                            selectedFragment = new AllclassFragment();
                            webView.loadUrl("https://smartpresenceupnvj.my.id/allclass");

                            break;
                        case R.id.nav_profile:
                            selectedFragment = new ProfileFragment();
                            webView.loadUrl("https://smartpresenceupnvj.my.id/Profile");
                    }

                    getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container,
                            selectedFragment).commit();

                    return true;
                }
            };


    //Bottom Navigation

}


