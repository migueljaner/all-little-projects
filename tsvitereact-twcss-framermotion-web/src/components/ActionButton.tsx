import { SelectedPage } from "@/shared/types.d";
import React from "react";
import AnchorLink from "react-anchor-link-smooth-scroll";

type Props = {
  children?: React.ReactNode;
  setSelectedPage: (page: SelectedPage) => void;
};

const ActionButton: React.FC<Props> = ({ children, setSelectedPage }) => {
  return (
    <AnchorLink
      className="rounded-md bg-secondary-500 px-10 py-2 transition duration-500 ease-in-out hover:bg-primary-500 hover:text-white"
      onClick={() => {
        setSelectedPage(SelectedPage.ContactUs);
      }}
      href={`#${SelectedPage.ContactUs}`}
    >
      {children}
    </AnchorLink>
  );
};

export default ActionButton;
