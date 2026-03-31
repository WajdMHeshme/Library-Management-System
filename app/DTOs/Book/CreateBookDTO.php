<?php

namespace App\DTOs\Book;

use Illuminate\Http\UploadedFile;

class CreateBookDTO
{
    public function __construct(
        public string $title,
        public string $author,
        public ?int $categoryId,
        public ?string $availability,
        public ?UploadedFile $coverImage,
        public ?string $description,
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            title: $request->title,
            author: $request->author,
            categoryId: $request->category_id ?? null,
            availability: $request->availability ?? 'sale',
            coverImage: $request->file('cover_image'),
            description: $request->description ?? null,
        );
    }

    public function hasImage(): bool
    {
        return $this->coverImage instanceof UploadedFile;
    }

    public function storeImage(): ?string
    {
        return $this->hasImage()
            ? $this->coverImage->store('books', 'public')
            : null;
    }

    public function toArray(?string $imagePath = null): array
    {
        return [
            'title' => $this->title,
            'author' => $this->author,
            'category_id' => $this->categoryId,
            'availability' => $this->availability,
            'cover_image' => $imagePath,
            'description' => $this->description,
        ];
    }
}
