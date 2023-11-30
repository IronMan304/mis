
<x-app-layout>

    <div class="content">

        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="good-morning-blk">
            <div class="row">
                <div class="col-md-6">
                    <div class="morning-user">
                        <h2>
                            @if ($time < 12) Good Morning, @elseif ($time < 17) Good Afternoon, @else Good Evening, @endif <span class="text-capitalize">
                                {{ auth()->user()->first_name }}
                                {{ auth()->user()->last_name }}
                                </span>
                        </h2>
                        <p>Have a nice day at work</p>
                    </div>
                </div>
                <div class="col-md-6 position-blk">
                    <div class="morning-img">
                        <img src="assets/img/morning-img-01.png" alt>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
