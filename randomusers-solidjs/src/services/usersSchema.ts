import { z } from "zod";
import { Gender, Title } from "../types";

export const infoSchema = z.object({
  seed: z.string(),
  results: z.number(),
  page: z.number(),
  version: z.string(),
});

export const dobSchema = z.object({
  date: z.string(),
  age: z.number(),
});

export const genderSchema = z.nativeEnum(Gender);

export const idSchema = z.object({
  name: z.string(),
  value: z.string().nullable(),
});

export const coordinatesSchema = z.object({
  latitude: z.string(),
  longitude: z.string(),
});

export const streetSchema = z.object({
  number: z.number(),
  name: z.string(),
});

export const timezoneSchema = z.object({
  offset: z.string(),
  description: z.string(),
});

export const loginSchema = z.object({
  uuid: z.string(),
  username: z.string(),
  password: z.string(),
  salt: z.string(),
  md5: z.string(),
  sha1: z.string(),
  sha256: z.string(),
});

export const titleSchema = z.nativeEnum(Title);

export const pictureSchema = z.object({
  large: z.string(),
  medium: z.string(),
  thumbnail: z.string(),
});

export const locationSchema = z.object({
  street: streetSchema,
  city: z.string(),
  state: z.string(),
  country: z.string(),
  postcode: z.union([z.number(), z.string()]),
  coordinates: coordinatesSchema,
  timezone: timezoneSchema,
});

export const nameSchema = z.object({
  title: titleSchema,
  first: z.string(),
  last: z.string(),
});

export const userSchema = z.object({
  gender: genderSchema,
  name: nameSchema,
  location: locationSchema,
  email: z.string(),
  login: loginSchema,
  dob: dobSchema,
  registered: dobSchema,
  phone: z.string(),
  cell: z.string(),
  id: idSchema,
  picture: pictureSchema,
  nat: z.string(),
});

export const aPIResultsSchema = z.object({
  results: z.array(userSchema),
  info: infoSchema,
});
