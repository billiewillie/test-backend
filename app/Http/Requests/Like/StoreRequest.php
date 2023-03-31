<?php

    namespace App\Http\Requests\Like;

    use Illuminate\Foundation\Http\FormRequest;

    class StoreRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
         */
        public function rules(): array
        {
            return [
                "post_id" => "required|integer|exists:posts,id",
                "user_token" => "required|string|exists:users,user_token",
                "is_liked" => "required|boolean"
            ];
        }
    }
