<?php

namespace App\Utils;

use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator as LengthAwarePaginatorContract;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Paginator
{
    /**
     * @var Collection
     */
    private $items;

    /**
     * @var int
     */
    private $total;

    /**
     * @var int
     */
    private $perPage;

    /**
     * @var int
     */
    private $page;

    /**
     * コンストラクタ
     * @param Collection $items
     * @param int $total
     * @param int $perPage
     * @param int $page
     */
    public function __construct(Collection $items, int $total, int $perPage, int $page)
    {
        $this->items = $items;
        $this->total = $total;
        $this->perPage = $perPage;
        $this->page = $page;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param QueryBuilder|EloquentBuilder $query
     * @param int $perPage
     * @param int $page
     * @return Paginator
     */
    public static function fromQueryBuilder($query, int $perPage, int $page)
    {
        if ($query instanceof EloquentBuilder) {
            $total = $query->getQuery()->getCountForPagination();
        } else if ($query instanceof QueryBuilder) {
            $total = $query->getCountForPagination();
        } else {
            throw new \InvalidArgumentException(
                '$query must be instance of`' . QueryBuilder::class . ' or ' . EloquentBuilder::class
            );
        }
        $items = $query->forPage($page, $perPage)->get();
        return new self(
            $items,
            $total,
            $perPage,
            $page
        );
    }

    /**
     * @param $callback
     * @return mixed
     */
    public function max($callback)
    {
        return $this->items->max($callback);
    }

    /**
     * @param $callback
     * @return mixed
     */
    public function min($callback)
    {
        return $this->items->min($callback);
    }

    /**
     * @param callable $callback
     * @return Paginator
     */
    public function map(callable $callback): self
    {
        $newItems = $this->items->map($callback);
        return new self(
            $newItems,
            $this->total,
            $this->perPage,
            $this->page
        );
    }

    /**
     * @param array $options
     * @return LengthAwarePaginatorContract
     */
    public function toPresentation(array $options = []): LengthAwarePaginatorContract
    {
        return new LengthAwarePaginator(
            $this->items,
            $this->total,
            $this->perPage,
            $this->page,
            $options
        );
    }
}
