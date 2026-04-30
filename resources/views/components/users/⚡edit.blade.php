<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    public User $user;

    #[Validate]
    public string $first_name = '';
    #[Validate]
    public string $last_name = '';
    #[Validate]
    public string $phone = '';

    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255', 'regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/', Rule::unique(User::class, 'phone')->ignore($this->user)],
        ];
    }

    public function mount(): void
    {
        $this->user = Auth::user();
        $this->first_name = $this->user->first_name;
        $this->last_name = $this->user->last_name;
        $this->phone = $this->user->phone;
    }

    public function cancel(): void
    {
        $this->dispatch('close-users-edit-form');
    }

    public function save(): void
    {
        $this->validate();

        $this->user->update([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
        ]);

        $this->dispatch('close-users-edit-form');
    }
};
?>

<div>
    <x-forms.modal-form
        event="users-edit"
        title="Редактировать профиль"
        end-button-text="Сохранить"
    >
        <x-inputs.input
            label="Имя"
            type="text"
            name="first_name"
            id="users_edit_first_name"
            placeholder="Иван"
        />

        <x-inputs.input
            label="Фамилия"
            type="text"
            name="last_name"
            id="users_edit_last_name"
            placeholder="Иванов"
        />

        <x-inputs.input
            label="Номер телефона"
            type="tel"
            name="phone"
            id="users_edit_phone"
            placeholder="+7 (000) 000-00-00"
        />
    </x-forms.modal-form>
</div>
