"use client";
import React, { useEffect, useState, useMemo } from "react";
import Link from "next/link";
import PinterestIcon from "./icons/Pinterest";
import NotifIcon from "@/components/icons/Notif";
import MessageIcon from "@/components/icons/Message";
import ArrowDownIcon from "@/components/icons/ArrowDown";
import MagnifierIcon from "@/components/icons/Magnifier";
import Image from "next/image";
import { useRouter } from "next/compat/router";

const Navbar = () => {
  const router = useRouter();

  const isActive = (path: string) => router?.pathname === path;

  const MemoizedPinterestIcon = useMemo(() => <PinterestIcon />, []);
  const MemoizedArrowDownIcon = useMemo(() => <ArrowDownIcon />, []);
  const MemoizedNotifIcon = useMemo(() => <NotifIcon />, []);
  const MemoizedMagnifierIcon = useMemo(() => <MagnifierIcon />, []);
  const MemoizedMessageIcon = useMemo(() => <MessageIcon />, []);
  const MemoizedImage = useMemo(() => (
    <Image
      className="rounded-full"
      src="https://i.pinimg.com/75x75_RS/91/11/cd/9111cdbd2303a1ffa4a40013392cc99d.jpg"
      alt="avatar"
      width={32}
      height={32}
    />
  ), []);

  return (
    <div className="px-6 py-4 flex justify-between items-center font-semibold">
      {MemoizedPinterestIcon}
      <nav className="ml-4">
        <ul className="flex gap-6">
          <li>
            <Link href="/" className={`px-3 py-1 rounded-full ${isActive("/") ? "bg-black text-white" : ""}`}>
                Home
            </Link>
          </li>
          <li>
            <Link href="/explore" className={`px-3 py-1 rounded-full ${isActive("/explore") ? "bg-black text-white" : ""}`}>              
                Explore
            </Link>
          </li>
          <li className="flex items-center gap-2">
            <span className={`px-3 py-1 rounded-full ${isActive("/create") ? "bg-black text-white" : ""}`}>
              Create
            </span>
            {MemoizedArrowDownIcon}
          </li>
        </ul>
      </nav>
      <div className="bg-slate-200 rounded-3xl w-full px-4 flex justify-between items-center mx-3">
        {MemoizedMagnifierIcon}
        <input type="text" className="w-full bg-slate-200 ml-3 pe-6 py-3 focus:outline-none" placeholder="Search" />
      </div>
      <div className="flex gap-6 items-center">
        {MemoizedNotifIcon}
        {MemoizedMessageIcon}
        <div className="flex gap-2 items-center">
          {MemoizedImage}
          <span className="ml-2 mr-5">
            {MemoizedArrowDownIcon}
          </span>
        </div>
      </div>
    </div>
  );
};

export default Navbar;
