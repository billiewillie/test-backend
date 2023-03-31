<?php

    namespace App\Http\Requests\Post;

    use Illuminate\Foundation\Http\FormRequest;

    class UpdateRequest extends FormRequest
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
         * @return array<string, Illuminate\Contracts\Validation\Rule|array|string>
         */
        public function rules(): array
        {
            return [
                "title" => "required|string",
                "author_id" => "required|integer|exists:users,id",
                "category_id" => "required|integer|exists:categories,id",
                "is_published" => "boolean",
                "url" => "nullable|string",
                "description" => "min:3|max:200",
                "content" => "min:3",
                "preview_image" => "nullable|image",
                "published_date" => "date_format:Y-m-d",
                "unpublished_date" => "nullable|date_format:Y-m-d"
            ];
        }
    }
