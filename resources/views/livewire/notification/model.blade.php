<li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter">
            {{ $count}}
        </span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Notifications
        </h6>
       
        @forelse($notifications as $notification)

        <a class="dropdown-item d-flex align-items-center {{ is_null($notification->read_at) ? '' : 'bg-light text-secondary'}}" 
            href="{{ route($notification->data['view'],['id' => $notification->id])}}">
            <div class="mr-3">
                
                <div class="{{ $notification->data["icon"] }}">
                    <i class="fas fa-file-alt text-white"></i>
                </div>
            </div>
            <div>
                <div class="small text-gray-500">{{ \Carbon\Carbon::createFromDate($notification->created_at)->format('M d Y H:i:s')}}</div>
                <span class="font-weight-bold">{{ $notification->data["text"] }}</span>
            </div>
        </a>
        @empty
        <a class="dropdown-item d-flex align-items-center">
            <div>
                <div class="small text-gray-500">No Notifications</div>
                <span class="font-weight-bold"></span>
            </div>
        </a>
        @endforelse
        <a class="dropdown-item text-center small text-gray-500" href="{{ route('agent.notification.index')}}">Show All Notifications</a>
    </div>
</li>
 