<ul class="sidebar-menu">
    <li class="header"><strong>MAIN NAVIGATION</strong></li>
    <li>
        <a href="#">
            <i class="icon icon-sailing-boat-water purple-text s-18"></i> <span>Dashboard</span>
        </a>
    </li>

    <!-- ROLE -->
    @can('master')
        <li class="header light"><strong>MASTER</strong></li>
        @can('role')
            <li class="treeview">
                <a href="#">
                    <i class="icon icon-flag text-red s-18"></i> <span>Access</span>
                    <i class="icon icon-angle-left s-18 pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ route('role.index') }}">
                            <i class="icon icon-key4 amber-text s-18"></i> <span>Role</span>
                        </a>
                    </li>
                    <li class="no-b">
                        <a href="{{ route('permission.index') }}">
                            <i class="icon icon-document-list text-success s-18"></i> <span>Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endcan
        @can('pegawai')
            <li>
                <a href="{{ route('pegawai.index') }}">
                    <i class="icon icon-users text-blue s-18"></i> <span>Pegawai</span>
                </a>
            </li>
        @endcan

        <li>
            <a href="{{ route('poli.index') }}">
                <i class="icon icon-document text-blue s-18"></i> <span>Poli</span>
            </a>
        </li>

        <li>
            <a href="{{ route('pengunjung.index') }}">
                <i class="icon icon-document text-blue s-18"></i>
                <span>Pengunjung</span>
            </a>
        </li>

        <li>
            <a href="{{ route('antrian.index') }}">
                <i class="icon icon-document text-blue s-18"></i>
                <span>Antrian</span>
            </a>
        </li>
    @endcan
</ul>
