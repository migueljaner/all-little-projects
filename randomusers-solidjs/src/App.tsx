import type { Accessor, Component } from "solid-js";
import { For, createMemo, createSignal } from "solid-js";

import styles from "./App.module.css";

import { User } from "./types";
import { Table, TableCaption, Thead, Tbody, Tr, Th } from "@hope-ui/solid";

import usePagination from "./hooks/useUsers";
import { fetchUsers } from "./services/users";
import ActionButtons from "./Components/ActionButtons";
import { Chip } from "@suid/material";
import UsersList from "./Components/UsersList";

const App: Component = () => {
  const { data, setNextPage, setAllData } = usePagination();
  const [sort, setSort] = createSignal(false);

  const handleReset = async (): Promise<void> => {
    fetchUsers(1).then((res) => setAllData(res.users));
  };
  const handleDelete = (uuid: string, index: Accessor<number>): void => {
    setAllData((prev) => {
      const newData = [...sortedData()]; // create a copy of the array
      newData.splice(index(), 1); // remove the element at the index
      return newData;
    });
    // setAllData((prev) => prev.filter((user) => user.login.uuid !== uuid));
  };

  const sortedData = createMemo<User[]>(() => {
    if (sort()) {
      return [...data()]?.sort((a: User, b: User) => {
        if (a.name.first < b.name.first) {
          return -1;
        }
        if (a.name.first > b.name.first) {
          return 1;
        }
        return 0;
      });
    } else {
      return [...data()];
    }
  });

  return (
    <div class={styles.App}>
      <header class={styles.header} style={{}}>
        <ActionButtons
          setSort={setSort}
          setNextPage={setNextPage}
          handleReset={handleReset}
        />
      </header>
      <Chip
        label={`${sortedData().length} Total Users`}
        color="default"
        variant="outlined"
        style={{
          "margin-top": "50px",
          "font-size": "30px",
          border: "0px",
          color: "white",
          "text-decoration": "underline",
          "line-height": "bold",
          "font-weight": "bold",
          "padding-bottom": "40px",
        }}
      />

      <Table dense style={{ width: "90%" }}>
        <TableCaption>Users</TableCaption>
        <Thead>
          <Tr>
            <Th>Email</Th>
            <Th>Name</Th>
            <Th>Actions</Th>
          </Tr>
        </Thead>
        <Tbody>
          <For each={sortedData()} fallback={<p>Loading...</p>}>
            {(user: User, index) => (
              <UsersList
                user={user}
                index={index}
                handleDelete={handleDelete}
              />
            )}
          </For>
        </Tbody>
      </Table>
    </div>
  );
};

export default App;
