import { aPIResultsSchema } from "./usersSchema";
import { User } from "../types";
export const fetchUsers = async (
  page: number = 1
): Promise<{ users: User[]; nextPage: number }> => {
  return await fetch(
    `https://randomuser.me/api/?results=1000&seed=abc&page=${page}`
  )
    .then(async (res) => {
      if (!res.ok) throw new Error("Error fetching users");

      const data = await res.json();

      const parsedData = await aPIResultsSchema.parseAsync(data);

      return parsedData;
    })
    .then((data) => {
      const currentPage = Number(data.info.page);
      const nextPage = currentPage + 1;
      return {
        users: data.results,
        nextPage,
      };
    });
};
