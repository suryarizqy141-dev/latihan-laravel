<!DOCTYPE html>
<html>
<head>
    <title>Uji Coba API (Bagian 7)</title>
    <style>
        body { font-family: sans-serif; margin: 24px; line-height: 1.6; }
        .box { border: 1px solid #ccc; padding: 16px; margin-bottom: 20px; border-radius: 6px; }
        input, button, select { padding: 6px 10px; margin: 4px 0; }
        pre { background: #f4f4f4; padding: 10px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>Pengujian Endpoint API (Bagian 7)</h1>
    <p><a href="{{ url('/') }}">&larr; Kembali ke Beranda</a></p>

    {{-- a. Form Login --}}
    <div class="box">
        <h3>a. Form Login API (POST <code>/api/login</code>)</h3>
        <form method="POST" action="{{ url('/api/login') }}" target="_blank">
            <label>Email:</label><br>
            <input type="email" name="email" value="admin@example.com" required><br>
            <label>Password:</label><br>
            <input type="password" name="password" value="password" required><br><br>
            <button type="submit">Login API</button>
        </form>
    </div>

    {{-- b. Update Profile --}}
    <div class="box">
        <h3>b. Update Profile API (PUT <code>/api/profile</code>)</h3>
        <p><i>Catatan: Membutuhkan Header <code>Authorization: Bearer &lt;token&gt;</code></i></p>
        <form id="profileForm">
            <label>Token Bearer:</label><br>
            <input type="text" id="profileToken" style="width: 400px;" placeholder="Tempel token di sini"><br>
            <label>Nama:</label><br>
            <input type="text" id="profileName" value="Nama Baru"><br>
            <label>Email:</label><br>
            <input type="email" id="profileEmail" value="userbaru@example.com"><br>
            <label>Password:</label><br>
            <input type="password" id="profilePassword" value="newpassword"><br><br>
            <button type="button" onclick="sendProfileUpdate()">Update Profile via Fetch</button>
        </form>
        <pre id="profileResult">Hasil respons akan tampil di sini...</pre>
    </div>

    {{-- c. Admin Update User --}}
    <div class="box">
        <h3>c. Admin Update User (PUT <code>/api/users/{id}</code>)</h3>
        <form id="adminUserForm">
            <label>Token Bearer Admin:</label><br>
            <input type="text" id="adminToken" style="width: 400px;" placeholder="Tempel token admin di sini"><br>
            <label>ID User:</label><br>
            <input type="number" id="targetUserId" value="1" style="width: 80px;"><br>
            <label>Nama:</label><br>
            <input type="text" id="adminUserName" value="User Diedit Admin"><br>
            <label>Email:</label><br>
            <input type="email" id="adminUserEmail" value="adminedit@example.com"><br>
            <label>Role:</label><br>
            <select id="adminUserRole">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select><br><br>
            <button type="button" onclick="sendAdminUpdateUser()">Update User via Fetch</button>
        </form>
        <pre id="adminResult">Hasil respons akan tampil di sini...</pre>
    </div>

    <script>
        async function sendProfileUpdate() {
            const token = document.getElementById('profileToken').value.trim();
            const resBox = document.getElementById('profileResult');
            resBox.innerText = 'Mengirim permintaan...';

            try {
                const response = await fetch("{{ url('/api/profile') }}", {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({
                        name: document.getElementById('profileName').value,
                        email: document.getElementById('profileEmail').value,
                        password: document.getElementById('profilePassword').value
                    })
                });
                const data = await response.json();
                resBox.innerText = JSON.stringify(data, null, 2);
            } catch (err) {
                resBox.innerText = 'Error: ' + err.message;
            }
        }

        async function sendAdminUpdateUser() {
            const token = document.getElementById('adminToken').value.trim();
            const id = document.getElementById('targetUserId').value;
            const resBox = document.getElementById('adminResult');
            resBox.innerText = 'Mengirim permintaan...';

            try {
                const response = await fetch("{{ url('/api/users') }}/" + id, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'Authorization': 'Bearer ' + token
                    },
                    body: JSON.stringify({
                        name: document.getElementById('adminUserName').value,
                        email: document.getElementById('adminUserEmail').value,
                        role: document.getElementById('adminUserRole').value
                    })
                });
                const data = await response.json();
                resBox.innerText = JSON.stringify(data, null, 2);
            } catch (err) {
                resBox.innerText = 'Error: ' + err.message;
            }
        }
    </script>
</body>
</html>
