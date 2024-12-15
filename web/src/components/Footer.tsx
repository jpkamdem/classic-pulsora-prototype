import facebookIcon from "../assets/social/facebook.png";
import instagramIcon from "../assets/social/instagram.png";
import linkedinIcon from "../assets/social/linkedin.png";
import snapchatIcon from "../assets/social/snapchat.png";
import twitterIcon from "../assets/social/twitter.png";
import pulsoraLogo from "../assets/pulsora-1.png";

export default function Footer() {
  return (
    <footer className="bg-white text-blue-800">
      <div className=" py-6">
        <div className=" flex justify-center">
          <img className="w-12" src={pulsoraLogo} alt="Logo Pulsora" />
        </div>
        <div className="text-center  my-4">
          <p>+33 7 58 63 65 89</p>
          <p>17 rue Jablinot, 77100 Meaux</p>
        </div>

        <div>
          <ul className="flex justify-center space-x-6 ">
            <li>
              <img className="w-8" src={facebookIcon} alt="Logo Facebook" />
            </li>
            <li>
              <img className="w-8" src={linkedinIcon} alt="Logo Linkedin" />
            </li>
            <li>
              <img className="w-8" src={snapchatIcon} alt="Logo Snapchat" />
            </li>
            <li>
              <img className="w-8" src={twitterIcon} alt="Logo Twitter" />
            </li>
            <li>
              <img className="w-8" src={instagramIcon} alt="Logo Instagram" />
            </li>
          </ul>
        </div>
      </div>

      <hr className="h-px my-4 bg-blue-900 opacity-65 border-0 mx-16" />

      <div className="flex  flex-col md:flex-row justify-between items-center px-16 space-x-6 py-4">
        <nav className="flex space-x-4 text-sm">
          <a href="#" className="hover:underline">
            Accueil
          </a>
          <a href="#" className="hover:underline">
            À propos
          </a>
          <a href="#" className="hover:underline">
            Services
          </a>
          <a href="#" className="hover:underline">
            Contact
          </a>
        </nav>

        <p className="text-sm mt-4 md:mt-0">
          © 2024 Votre Entreprise. Tous droits réservés.
        </p>
      </div>
    </footer>
  );
}
