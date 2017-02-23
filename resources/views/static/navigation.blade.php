<!-- Fixed navbar -->
<nav class="navbar navbar-default pull">
    <div class="container center-block">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="<?php echo URL::to('/')?>">
                    makeyourtournament
                </a>
        </div>

        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
            {{--******************************************* FÜR ALLE SICHTBAR *************************************************--}}
                <li><a href="<?php echo URL::to('/')?>"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="<?php echo URL::to('/impressum')?>"><i class="fa fa-align-justify"></i> Impressum & Datenschutz</a></li>

                {{--******************************************* FÜR ALLE DIE ANGEMELDET SIND *************************************************--}}
                @if (!Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="fa fa-user" aria-hidden="true"></span> Angemeldet als {{Auth::user()->username}}<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo URL::to('/settings')?>"><i class="fa fa-cogs"></i> Einstellungen</a>
                            </li>
                            <li>
                                <a href="<?php echo URL::to('/logout')?>"><i class="fa fa-sign-out"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>