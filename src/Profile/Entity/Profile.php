<?php
/**
 * Copyright (c) 2014 Shine Software.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 * * Redistributions of source code must retain the above copyright
 * notice, this list of conditions and the following disclaimer.
 *
 * * Redistributions in binary form must reproduce the above copyright
 * notice, this list of conditions and the following disclaimer in
 * the documentation and/or other materials provided with the
 * distribution.
 *
 * * Neither the names of the copyright holders nor the names of the
 * contributors may be used to endorse or promote products derived
 * from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package Profile
 * @subpackage Entity
 * @author Michelangelo Turillo <mturillo@shinesoftware.com>
 * @copyright 2014 Michelangelo Turillo.
 * @license http://www.opensource.org/licenses/bsd-license.php BSD License
 * @link http://shinesoftware.com
 * @version @@PACKAGE_VERSION@@
 */

namespace Profile\Entity;

class Profile implements ProfileInterface
{ 
    public $id;
    public $category_id;
    public $user_id;
    public $name;
    public $slug;
    public $biography;
    public $slogan;
    public $googleplus;
    public $facebook;
    public $twitter;
    public $instagram;
    public $paypal;
    public $url;
    public $address;
    public $telephone;
    public $latitude;
    public $longitude;
    public $file;
    public $public;
    public $createdat;
    public $updatedat;

    /**
     * 
     * @param array $data
     */
    function exchangeArray ($data)
    {
        foreach ($data as $field => $value){
            $this->$field = (isset($value)) ? $value : null;
        }
    }
    
	/**
     * @return the $id
     */
    public function getId ()
    {
        return $this->id;
    }

	/**
     * @param field_type $id
     */
    public function setId ($id)
    {
        $this->id = $id;
    }

	/**
     * @return the $category_id
     */
    public function getCategoryId ()
    {
        return $this->category_id;
    }

	/**
     * @param field_type $category_id
     */
    public function setCategoryId ($category_id)
    {
        $this->category_id = $category_id;
    }
	/**
     * @return the $user_id
     */
    public function getUserId ()
    {
        return $this->user_id;
    }

	/**
     * @param field_type $user_id
     */
    public function setUserId ($user_id)
    {
        $this->user_id = $user_id;
    }

	/**
     * @return the $name
     */
    public function getName ()
    {
        return $this->name;
    }

	/**
     * @param field_type $name
     */
    public function setName ($name)
    {
        $this->name = $name;
    }

	/**
     * @return the $createdat
     */
    public function getCreatedat ()
    {
        return $this->createdat;
    }

	/**
     * @param field_type $createdat
     */
    public function setCreatedat ($createdat)
    {
        $this->createdat = $createdat;
    }

	/**
     * @return the $updatedat
     */
    public function getUpdatedat ()
    {
        return $this->updatedat;
    }

	/**
     * @param field_type $updatedat
     */
    public function setUpdatedat ($updatedat)
    {
        $this->updatedat = $updatedat;
    }
	/**
     * @return the $file
     */
    public function getFile ()
    {
        return $this->file;
    }

	/**
     * @param field_type $file
     */
    public function setFile ($file)
    {
        $this->file = $file;
    }
	/**
     * @return the $slug
     */
    public function getSlug ()
    {
        return $this->slug;
    }

	/**
     * @param field_type $slug
     */
    public function setSlug ($slug)
    {
        $this->slug = $slug;
    }
	/**
     * @return the $biography
     */
    public function getBiography ()
    {
        return $this->biography;
    }

	/**
     * @param field_type $biography
     */
    public function setBiography ($biography)
    {
        $this->biography = $biography;
    }
	/**
     * @return the $slogan
     */
    public function getSlogan ()
    {
        return $this->slogan;
    }

	/**
     * @param field_type $slogan
     */
    public function setSlogan ($slogan)
    {
        $this->slogan = $slogan;
    }

	/**
     * @return the $facebook
     */
    public function getFacebook ()
    {
        return $this->facebook;
    }

	/**
     * @param field_type $facebook
     */
    public function setFacebook ($facebook)
    {
        $this->facebook = $facebook;
    }

	/**
     * @return the $twitter
     */
    public function getTwitter ()
    {
        return $this->twitter;
    }

	/**
     * @param field_type $twitter
     */
    public function setTwitter ($twitter)
    {
        $this->twitter = $twitter;
    }

	/**
     * @return the $instagram
     */
    public function getInstagram ()
    {
        return $this->instagram;
    }

	/**
     * @param field_type $instagram
     */
    public function setInstagram ($instagram)
    {
        $this->instagram = $instagram;
    }

	/**
     * @return the $paypal
     */
    public function getPaypal ()
    {
        return $this->paypal;
    }

	/**
     * @param field_type $paypal
     */
    public function setPaypal ($paypal)
    {
        $this->paypal = $paypal;
    }

	/**
     * @return the $url
     */
    public function getUrl() {
        return $this->url;
    }

	/**
     * @param field_type $url
     */
    public function setUrl($url) {
        $this->url = $url;
    }

	/**
     * @return the $address
     */
    public function getAddress ()
    {
        return $this->address;
    }

	/**
     * @param field_type $address
     */
    public function setAddress ($address)
    {
        $this->address = $address;
    }

	/**
     * @return the $telephone
     */
    public function getTelephone ()
    {
        return $this->telephone;
    }

	/**
     * @param field_type $telephone
     */
    public function setTelephone ($telephone)
    {
        $this->telephone = $telephone;
    }

	/**
     * @return the $latitude
     */
    public function getLatitude ()
    {
        return $this->latitude;
    }

	/**
     * @param field_type $latitude
     */
    public function setLatitude ($latitude)
    {
        $this->latitude = $latitude;
    }

	/**
     * @return the $longitude
     */
    public function getLongitude ()
    {
        return $this->longitude;
    }

	/**
     * @param field_type $longitude
     */
    public function setLongitude ($longitude)
    {
        $this->longitude = $longitude;
    }
	/**
     * @return the $googleplus
     */
    public function getGoogleplus ()
    {
        return $this->googleplus;
    }

	/**
     * @param field_type $googleplus
     */
    public function setGoogleplus ($googleplus)
    {
        $this->googleplus = $googleplus;
    }
	/**
     * @return the $public
     */
    public function getPublic() {
        return $this->public;
    }

	/**
     * @param field_type $public
     */
    public function setPublic($public) {
        $this->public = $public;
    }
	
}