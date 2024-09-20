<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
</head>
<body>
    <h1>Manage Users</h1>
    <table>
        <thead>
            <tr>
                <th>Email</th>
                <th>Admin</th>
                <th>User Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
                    <td>{{ $user->user_type }}</td>
                    <td>
                        <form action="{{ url('/admin/users/' . $user->id . '/update') }}" method="POST">
                            @csrf
                            <label for="is_admin">Admin:</label>
                            <select name="is_admin">
                                <option value="0" {{ $user->is_admin ? '' : 'selected' }}>No</option>
                                <option value="1" {{ $user->is_admin ? 'selected' : '' }}>Yes</option>
                            </select>
                            <br>
                            <label for="user_type">User Type:</label>
                            <select name="user_type">
                                <option value="kaprodi" {{ $user->user_type == 'kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                                <option value="dosen" {{ $user->user_type == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="mahasiswa" {{ $user->user_type == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            </select>
                            <br>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
