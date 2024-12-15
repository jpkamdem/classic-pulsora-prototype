import stadiumOne from "../assets/stadium-1.png";
import playerHome from "../assets/playerhome.png";
import rightArrow from "../assets/right-arrow.png";

export default function Home() {
  return (
    <>
      <div className="flex justify-center lg:items-center relative py-10">
        <img className="w-3/6 md:w-2/6" src={playerHome} alt="Player Home" />
        <div className="text-center absolute bottom-0 lg:relative">
          <h1 className="text-4xl font-bold lg:text-8xl ">PULSORA</h1>
          <h2 className="text-3xl font-semibold lg:text-7xl text-blue-900">
            LOREM
          </h2>
        </div>
      </div>

      <div className=" my-20 text-center">
        <button className="bg-blue-900 text-white font-semibold px-4 py-2 rounded-3xl lg:text-xl lg:px-6 lg:py-3 lg:rounded-full">
          DECOUVRIR
        </button>
      </div>

      <div className="mx-auto w-5/6 text-center p-5 my-10 rounded-2xl border-2 border-slate-300 bg-white md:w-2/3 lg:w-2/3">
        <p className="text-center">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
          minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur. Duis aute irure dolor in reprehenderit in voluptate velit
          esse cillum dolore eu fugiat nulla pariatur.
        </p>
      </div>

      <div className="flex flex-col lg:flex-row lg:h-[calc(100vh-4rem)] gap-6  m-20 text-center">
        <div className="bg-white text-slate-600 p-0 rounded-3xl flex-1 lg:h-full  relative">
          <h2 className="text-2xl font-bold mt-4 lg:text-4xl lg:mt-8">
            ARTICLE
          </h2>
          <img className="w-1/3 mx-auto lg:w-1/2" src={stadiumOne} alt="" />
          <div className="w-16 h-16 bg-blue-800 rounded-full absolute right-2 bottom-2">
            <img
              className="w-1/2 mx-auto mt-4 -rotate-45 "
              src={rightArrow}
              alt=""
            />
          </div>
        </div>

        <div className="flex flex-col lg:w-1/3 lg:h-full gap-6">
          <div className="bg-teal-200 text-white p-0 rounded-3xl flex-1  relative ">
            <h2 className="text-2xl font-bold lg:text-4xl mt-4">SAISON</h2>
            <img className="w-1/3  mx-auto lg:w-1/2" src={stadiumOne} alt="" />
            <div className="w-16 h-16 bg-blue-800  rounded-full  absolute right-2  bottom-2">
              <img
                className="w-1/2 mx-auto mt-4 -rotate-45 "
                src={rightArrow}
                alt=""
              />
            </div>
          </div>

          <div className="bg-lime-700 text-white p-0 rounded-3xl flex-1 relative">
            <h2 className="text-2xl font-bold lg:text-4xl mt-4">EQUIPE</h2>
            <img className="w-1/3  mx-auto lg:w-1/2" src={stadiumOne} alt="" />
            <div className="w-16 h-16 bg-blue-800  rounded-full  absolute right-2  bottom-2">
              <img
                className="w-1/2 mx-auto mt-4 -rotate-45 "
                src={rightArrow}
                alt=""
              />
            </div>
          </div>
        </div>
      </div>
    </>
  );
}
