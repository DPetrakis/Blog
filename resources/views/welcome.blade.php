@extends('layouts.front-temp')

@section('content')
  
  <div style="height:100px"></div>
  
  
  
  <!-- Page Content -->

  
   
    
    <section class="blog-posts">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
             <posts-component></posts-component>
          </div>
          <div class="col-lg-4">
            <div class="sidebar">
              <div class="row">
                <div class="col-lg-12">
                  <div class="sidebar-item search">
                    <form id="search_form" name="gs" method="GET" action="#">
                      <input type="text" name="q" class="searchText" placeholder="type to search..." autocomplete="on">
                    </form>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item recent-posts">
                    <div class="sidebar-heading">
                      <h2 style="color:#FFA300;">Breaking News</h2>
                    </div>
                    <breaking-news-widget page = "index"></breaking-news-widget>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item categories">
                    <div class="sidebar-heading">
                      <h2>Categories</h2>
                    </div>
                    <categories-widget page = "index"></categories-widget>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                      <h2>Tag Clouds</h2>
                    </div>
                    <tags-widget></tags-widget>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="sidebar-item tags">
                    <div class="sidebar-heading">
                      <h2>Archives</h2>
                    </div>
                    <calendar page = "index"></calendar>
                  </div>
                </div>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

@endsection
