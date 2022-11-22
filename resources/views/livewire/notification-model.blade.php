<!-- Nav Item - Alerts -->
<li wire:poll class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-bell fa-fw"></i>
        <!-- Counter - Alerts -->
        <span class="badge badge-danger badge-counter">
            
        </span>
    </a>
    <!-- Dropdown - Alerts -->
    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
        aria-labelledby="alertsDropdown">
        <h6 class="dropdown-header">
            Notifications
        </h6>
       
        @forelse($notifications as $notification)
        <a class="dropdown-item d-flex align-items-center" href="#">
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
            <p class="font-weight-bold"></p>
        @endforelse
        <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
    </div>
</li>
