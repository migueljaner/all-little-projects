import { useId } from 'react';
import './Filters.css';
import { useFilters } from '../hooks/useFilters';

export default function Filters() {
  const { filter, setFilter } = useFilters(); // Custom Hook

  const minPriceFilterId = useId('min-price-filter-');
  const categoryFilterId = useId('category-filter-');

  const handleChangeMinPrice = (event) => {
    setFilter((prevState) => ({
      ...prevState,
      minPrice: event.target.value,
    }));
  };

  const handleChangeCategory = (event) => {
    setFilter((prevState) => ({
      ...prevState,
      category: event.target.value,
    }));
  };

  return (
    <section className="filters">
      <div>
        <label htmlFor={minPriceFilterId}>Min Price:</label>
        <input
          type="range"
          id={minPriceFilterId}
          name="min-price"
          min="0"
          max="1000"
          onChange={handleChangeMinPrice}
          value={filter.minPrice}
        />
        <span>{filter.minPrice}</span>
      </div>

      <div>
        <label htmlFor={categoryFilterId}>Category:</label>
        <select
          name="category"
          id={categoryFilterId}
          onChange={handleChangeCategory}
        >
          <option value="all">Todas</option>
          <option value="laptops">Poratiles</option>
          <option value="smartphones">Celulares</option>
        </select>
      </div>
    </section>
  );
}
