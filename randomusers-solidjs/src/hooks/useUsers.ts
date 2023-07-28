import { createSignal, createResource, createMemo } from "solid-js";
import { fetchUsers } from "../services/users";
import { User } from "../types";

const usePagination = () => {
  const [allData, setAllData] = createSignal<User[]>([]);
  const [currentPage, setNextPage] = createSignal<number>(1);
  const [data] = createResource<
    {
      users: User[];
      nextPage: number;
    },
    number
  >(currentPage, fetchUsers);

  createMemo(() => {
    if (data()?.users) {
      return setAllData<User[]>((prevData) => [...prevData, ...data()!.users]);
    }
  });

  return {
    data: allData,
    setNextPage,
    setAllData,
  };
};

export default usePagination;
