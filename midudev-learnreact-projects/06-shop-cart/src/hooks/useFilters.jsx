import { useContext } from 'react';
import { FilterContext } from '../context/Filters';

export function useFilters() {
  // Custom Hook
  /* const [filter, setFilter] = useState({
      category: 'all',
      minPrice: 0,
    }); */

  const { filter, setFilter } = useContext(FilterContext);

  const filterProducts = (products) => {
    return products.filter((product) => {
      return (
        product.price >= filter.minPrice &&
        (filter.category === 'all' || product.category === filter.category)
      );
    });
  };

  return { filter, setFilter, filterProducts };
}
