
<li class="{{ (request()->is('home')) ? 'active' : '' }}">
    <a href="/home">
        <i class="fa fa-th-large"></i> 
        <span>Dashboard</span> 
    </a>
</li>
<li class="has-sub {{ (request()->is('masterdata*')) ? 'active' : '' }}">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fa fa-th-large"></i>
        <span>Data Master</span>
    </a>
    <ul class="sub-menu">
        <li class="{{ (request()->is('masterdata/sekolah')) ? 'active' : '' }}"><a href="/masterdata/sekolah">Sekolah</a></li>
        <li class="{{ (request()->is('masterdata/jabatan')) ? 'active' : '' }}"><a href="/masterdata/jabatan">Jabatan</a></li>
    </ul>
</li>
<li class="has-sub {{ (request()->is('masterdata*')) ? 'active' : '' }}">
    <a href="javascript:;">
        <b class="caret"></b>
        <i class="fa fa-th-large"></i>
        <span>Report Data</span>
    </a>
    <ul class="sub-menu">
        <li class="{{ (request()->is('masterdata/sekolah')) ? 'active' : '' }}"><a href="#">Lap Sekolah</a></li>
        <li class="{{ (request()->is('masterdata/jabatan')) ? 'active' : '' }}"><a href="#">Lap Pegawai</a></li>
        <li class="{{ (request()->is('masterdata/jabatan')) ? 'active' : '' }}"><a href="#">Lap Siswa</a></li>
        <li class="{{ (request()->is('masterdata/jabatan')) ? 'active' : '' }}"><a href="#">Lap Jumlah Pegawai Semua</a></li>
        <li class="{{ (request()->is('masterdata/jabatan')) ? 'active' : '' }}"><a href="#">Lap Jumlah Siswa Semua</a></li>
    </ul>
</li>
<li class="{{ (request()->is('kelola_user')) ? 'active' : '' }}">
    <a href="/kelola_user">
        <i class="fa fa-th-large"></i> 
        <span>Kelola Users</span> 
    </a>
</li>
<li>
    <a href="/logout">
        <i class="fa fa-th-large"></i> 
        <span>Logout</span> 
    </a>
</li>