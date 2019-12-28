<li class="{{ (request()->is('home')) ? 'active' : '' }}">
    <a href="/home">
        <i class="fa fa-th-large"></i> 
        <span>Dashboard</span> 
    </a>
</li>
<li class="{{ (request()->is('pegawai')) ? 'active' : '' }}">
    <a href="/pegawai">
        <i class="fa fa-th-large"></i> 
        <span>Data Pegawai</span> 
    </a>
</li>
<li class="{{ (request()->is('siswa')) ? 'active' : '' }}">
    <a href="/siswa">
        <i class="fa fa-th-large"></i> 
        <span>Data Siswa</span> 
    </a>
</li>
<li class="{{ (request()->is('account')) ? 'active' : '' }}">
    <a href="/account">
        <i class="fa fa-th-large"></i> 
        <span>Setting Akun</span> 
    </a>
</li>
<li>
    <a href="/logout">
        <i class="fa fa-th-large"></i> 
        <span>Logout</span> 
    </a>
</li>