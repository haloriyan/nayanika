<div style="padding: 20px;background: #ecf0f1;">
    <div style="background: #fff;border: 1px solid #fff;border-radius: 6px;padding: 25px;">
        <p>Isian dari form website NayaNika</p>
        <div style="margin-top: 20px;">Nama : {{ $user['name'] }}</div>
        <div style="margin-top: 20px;">Email : {{ $user['email'] }}</div>
        <div style="margin-top: 20px;">Telepon : {{ $user['phone'] }}</div>
        <div style="margin-top: 20px;">Kota : {{ $user['city'] }}</div>
        <div style="margin-top: 20px;">Perusahaan : {{ $user['company'] }}</div>
        <div style="margin-top: 20px;">Industri : {{ $user['industry_field'] }}</div>

        <h3>Service :</h3>
        <div>{{ $user['services'] }}</div>
        <h3>Ala Carte :</h3>
        <div>{{ $user['alacartes'] }}</div>
    </div>
</div>