import { SelectedPage, OurClassType } from "@/shared/types.d";
import image1 from "@/assets/image1.png";
import image2 from "@/assets/image2.png";
import image3 from "@/assets/image3.png";
import image4 from "@/assets/image4.png";
import image5 from "@/assets/image5.png";
import image6 from "@/assets/image6.png";
import { motion } from "framer-motion";
import HText from "@/shared/HText";
import ClassCard from "./ClassCard";
type Props = {
  setSelectedPage: (page: SelectedPage) => void;
};

const ourclasses: Array<OurClassType> = [
  {
    name: "Yoga",
    description:
      "Yoga is a great way to improve your flexibility and strength. It also helps you relax and relieve stress. We offer a variety of classes for all levels, from beginner to advanced. Our instructors are certified and experienced in teaching yoga to people of all ages and abilities. You can find out more about our classes by clicking on the link below.",
    image: image1,
  },
  {
    name: "Pilates",
    description:
      "Pilates is a great way to improve your core strength and flexibility. It also helps you relax and relieve stress. We offer a variety of classes for all levels, from beginner to advanced. Our instructors are certified and experienced in teaching Pilates to people of all ages and abilities. You can find out more about our classes by clicking on the link below.",
    image: image2,
  },
  {
    name: "Zumba",
    description:
      "Zumba is a great way to get in shape and have fun at the same time. It’s a high-energy dance workout that combines Latin music with easy-to-follow moves. You’ll burn calories while you’re having a blast! We offer classes for all levels, from beginner to advanced. Our instructors are certified and experienced in teaching Zumba to people of all ages and abilities. You can find out more about our classes by clicking on the link below.",
    image: image3,
  },
  {
    name: "Boxing",
    description:
      "Boxing is a great way to get in shape and have fun at the same time. It’s a high-energy workout that combines boxing with cardio and strength training. You’ll burn calories while you’re having a blast! We offer classes for all levels, from beginner to advanced. Our instructors are certified and experienced in teaching boxing to people of all ages and abilities. You can find out more about our classes by clicking on the link below.",
    image: image4,
  },
  {
    name: "Cycling",
    description:
      "Cycling is a great way to get in shape and have fun at the same time. It’s a high-energy workout that combines cycling with cardio and strength training. You’ll burn calories while you’re having a blast! We offer classes for all levels, from beginner to advanced. Our instructors are certified and experienced in teaching cycling to people of all ages and abilities. You can find out more about our classes by clicking on the link below.",
    image: image5,
  },
  {
    name: "Dance",
    description:
      "Dance is a great way to get in shape and have fun at the same time. It’s a high-energy workout that combines dance with cardio and strength training. You’ll burn calories while you’re having a blast! We offer classes for all levels, from beginner to advanced. Our instructors are certified and experienced in teaching dance to people of all ages and abilities. You can find out more about our classes by clicking on the link below.",
    image: image6,
  },
];

const OurClasses = ({ setSelectedPage }: Props) => {
  return (
    <section className="w-full bg-primary-100 py-40" id="ourclasses">
      <motion.div
        onViewportEnter={() => setSelectedPage(SelectedPage.OurClasses)}
        className="flex flex-col items-center justify-center gap-8"
      >
        <motion.div
          className="mx-auto w-5/6"
          initial="hidden"
          whileInView="visible"
          viewport={{ once: true, amount: 0.5 }}
          transition={{ duration: 0.5 }}
          variants={{
            hidden: { opacity: 0, x: -50 },
            visible: { opacity: 1, x: 0 },
          }}
        >
          <div className="md:w-3/5">
            <HText>OUR CLASSES</HText>
            <p className="py-5 ">
              We offer a wide variety of classes to fit your needs. From
              strength training to cardio, we have it all. Our classes are
              designed to help you reach your goals and get the results you
              want. Whether you’re looking for a quick workout or an intense
              sweat session, we’ve got you covered.
            </p>
          </div>
        </motion.div>
        <div className="mt-10 h-[353px] w-full overflow-x-auto overflow-y-hidden">
          <ul className="w-[2800px] whitespace-nowrap">
            {ourclasses.map((item) => (
              <ClassCard key={item.name} {...item} />
            ))}
          </ul>
        </div>
      </motion.div>
    </section>
  );
};

export default OurClasses;
