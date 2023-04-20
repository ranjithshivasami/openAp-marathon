<ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle " src="../../assets/images/faces/face15.png" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                            @if (auth()->check())
                                <h5 class="mb-0 font-weight-normal">{{ auth()->user()->name }}</h5>
                            @endif
                        </div>
                        </div>
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">Navigation</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="{{ url('home') }}">
                        <span class="menu-icon">
                        <i class="mdi mdi-security"></i>
                        </span>
                        <span class="menu-title">Mail Setting</span>
                    </a>
                    
                </li>             
                <li  class="nav-item menu-items">
                <a class="nav-link" href="{{ url('mailnotification') }}">
                        <span class="menu-icon">
                        <i class="mdi mdi-security"></i>
                        </span>
                        <span class="menu-title">Mail Notification</span>
                    </a>
                </li>
            </ul>