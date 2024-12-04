<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'global_id',
        'full_name',
        'username',
        'email',
        'password',
        'email_verified_at',
        'photo',
        'phone',
        'address',
        'description',
        'ship_id',
        'ugroup_id',
        'role',
        'budget',
        'totalpoint',
        'totalrevenue',
        'taxcode',
        'taxname',
        'taxaddress',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // Hãy đảm bảo rằng Laravel hỗ trợ thuộc tính này trong phiên bản bạn đang dùng
    ];

    /**
     * Delete the user or mark as inactive based on role.
     *
     * @param int $user_id
     * @return int
     */
    public static function deleteUser($user_id)
    {
        $user = User::find($user_id);

        // Kiểm tra xem người dùng có tồn tại không
        if (!$user) {
            return -1; // Trả về -1 nếu người dùng không tìm thấy
        }

        if (auth()->user()->role == 'admin') {
            $user->delete();
            return 1; // Trả về 1 nếu người dùng đã được xóa
        } else {
            $user->status = "inactive";
            $user->save();
            return 0; // Trả về 0 nếu người dùng được đánh dấu là không hoạt động
        }
    }

    /**
     * Create a new user and assign a unique code.
     *
     * @param array $data
     * @return User
     */
    public static function c_create($data)
    {
        $pro = User::create($data);
        
        // Tạo mã cho người dùng mới
        $pro->code = "CUS" . sprintf('%09d', $pro->id);
        $pro->save();

        return $pro; // Trả về đối tượng người dùng mới
    }
}
