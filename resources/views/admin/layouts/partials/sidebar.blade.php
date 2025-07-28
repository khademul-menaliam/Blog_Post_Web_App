      <aside class="main-sidebar sidebar-dark-primary elevation-4">
         <a href="{{route('home')}}" class="brand-link text-center">
         <span class="brand-text font-weight-light">Blog CPanel</span>
         </a>
         <div class="sidebar">
            <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                  <li class="nav-item">
                     <a href="{{route('home')}}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                              Dashboard
                        </p>
                     </a>
                  </li>
                  {{-- Category --}}
                @canany(['admin.blog-category.view', 'admin.blog-category.create'])
                    <li class="nav-item {{ request()->routeIs('admin.category.*') ? 'menu-open' : '' }}">
                     <a href="" class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                           Category
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                        <ul class="nav nav-treeview">

                            @can('admin.blog-category.view')
                                <li class="nav-item">
                                <a href="{{route('admin.category.index')}}" class="nav-link {{ request()->routeIs('admin.category.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Category List</p>
                                </a>
                                </li>
                            @endcan

                            @can('admin.blog-category.create')
                                <li class="nav-item">
                                <a href="{{route('admin.category.create')}}" class="nav-link {{ request()->routeIs('admin.category.create') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Category</p>
                                </a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcanany

                {{-- blog --}}
                @canany(['admin.blog-post.view', 'admin.blog-post.create'])
                  <li class="nav-item {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog.*') ? 'menu-open' : '' }}">
                     <a href="#" class="nav-link {{ request()->routeIs('admin.blogs.*') || request()->routeIs('admin.blog.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-blog"></i>
                        <p>
                           Blog
                           <i class="right fas fa-angle-left"></i>
                        </p>
                     </a>
                     <ul class="nav nav-treeview">
                        @can('admin.blog-post.view')
                            <li class="nav-item">
                            <a href="{{route('admin.blogs.index')}}" class="nav-link {{ request()->routeIs('admin.blogs.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Post List</p>
                            </a>
                            </li>
                         @endcan
                        @can('admin.blog-post.create')
                            <li class="nav-item">
                            <a href="{{route('admin.blog.create')}}" class="nav-link {{ request()->routeIs('admin.blog.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add New Post</p>
                            </a>
                            </li>
                        @endcan
                     </ul>
                  </li>
                @endcanany
                {{-- pages admin --}}
                    @canany(['admin.about.edit', 'admin.privacy.edit', 'admin.terms.edit', 'admin.disclaimer.edit'])
                        <li class="nav-item {{ request()->routeIs('admin.pages.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->routeIs('admin.pages.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Pages
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                            @can('admin.privacy.edit')
                                <li class="nav-item">
                                    <a href="{{route('admin.pages.privacy')}}" class="nav-link {{ request()->routeIs('admin.pages.privacy') ? 'active' : '' }}">
                                        <i class="far fa-user-secret nav-icon"></i>
                                        <p>Privacy Policy</p>
                                    </a>
                                </li>
                            @endcan
                            @can('admin.terms.edit')
                                <li class="nav-item">
                                    <a href="{{route('admin.pages.terms')}}" class="nav-link {{ request()->routeIs('admin.pages.terms') ? 'active' : '' }}">
                                       <i class="far fa-file-contract nav-icon"></i>
                                       <p>Terms & Conditions</p>
                                    </a>
                                 </li>
                            @endcan
                            @can('admin.about.edit')
                                <li class="nav-item">
                                    <a href="{{route('admin.pages.about')}}" class="nav-link {{ request()->routeIs('admin.pages.about') ? 'active' : '' }}">
                                       <i class="far fa-info-circle nav-icon"></i>
                                       <p>About Us</p>
                                    </a>
                                 </li>
                            @endcan
                            @can('admin.disclaimer.edit')
                                <li class="nav-item">
                                    <a href="{{route('admin.pages.disclaimer')}}" class="nav-link {{ request()->routeIs('admin.pages.disclaimer') ? 'active' : '' }}">
                                       <i class="far fa-exclamation-circle nav-icon"></i>
                                       <p>Disclaimer</p>
                                    </a>
                                 </li>
                            @endcan
                            </ul>
                        </li>
                    @endcanany
                        {{-- Admin user  --}}
                    @canany(['admin.user.view', 'admin.user.create', 'admin.roles.view'])
                        <li class="nav-item {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ request()->routeIs('admin.users.*') || request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                <i class="nav-icon fas fa-user-shield"></i>
                                <p>
                                    Role & Permissions
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                @can('admin.user.view')
                                <li class="nav-item">
                                        <a href="{{route('admin.users.index')}}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                            <i class="far fa-users-cog nav-icon"></i>
                                            <p>Admin</p>
                                        </a>
                                    </li>
                                @endcan
                                @can('admin.roles.view')
                                    <li class="nav-item">
                                        <a href="{{route('admin.roles.index')}}" class="nav-link {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                            <i class="far fa-users nav-icon"></i>
                                            <p>Admin Roles</p>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcanany
                        {{-- contact --}}
                    <li class="nav-item">
                        <a href="{{route('admin.pages.contact')}}" class="nav-link {{ request()->routeIs('admin.pages.contact') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-envelope"></i>
                            <p>
                            Contact
                            </p>
                        </a>
                     </li>
                     {{-- advertisements --}}
                @canany(['admin.advertisement.edit', 'admin.advertisement.delete', 'admin.advertisement.view'])
                    <li class="nav-item">
                        <a href="{{route('admin.advertisement.index')}}" class="nav-link {{ request()->routeIs('admin.advertisement.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-ad"></i>
                            <p>
                                Advetisement
                            </p>
                        </a>
                    </li>
                @endcanany
                    {{-- settings --}}
                @can('admin.settings.edit')
                    <li class="nav-item">
                        <a href="{{route('admin.settings.index')}}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-cogs"></i>
                            <p>
                            Web Setting
                            <span class="right badge badge-danger">New</span>
                            </p>
                        </a>
                    </li>
                @endcan
                  <li class="nav-item">
                    <a onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"  href="{{ route('logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                    </form>
                  </li>
               </ul>
            </nav>
         </div>
      </aside>
