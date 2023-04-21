<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Primary Email</th>
            <th>Secondary Email</th>
            <th>Mail Server</th>
            <th>Port</th>
            <th>Protocol</th>
            <th>Password</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>User ID</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($userMailSettings as $userMailSetting)
        <tr>
            <td>{{ $userMailSetting->id }}</td>
            <td>{{ $userMailSetting->primary_email }}</td>
            <td>{{ $userMailSetting->secondary_email }}</td>
            <td>{{ $userMailSetting->mail_server }}</td>
            <td>{{ $userMailSetting->port }}</td>
            <td>{{ $userMailSetting->protocol }}</td>
            <td>{{ $userMailSetting->password }}</td>
            <td>{{ $userMailSetting->start_time }}</td>
            <td>{{ $userMailSetting->end_time }}</td>
            <td>{{ $userMailSetting->user_id }}</td>
            <td>                
                <a href="{{ route('user_mail_settings.edit', $userMailSetting->id) }}">Edit</a>
                <form action="{{ route('user_mail_settings.destroy', $userMailSetting->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    </tbody>